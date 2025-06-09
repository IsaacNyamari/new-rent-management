<?php
session_start();
class Dbh
{
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $database = "p_m_s";

    protected function Connect()
    {
        $conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
class Apartments extends Dbh
{
    // View methods
    public function viewApartments()
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM apartments";
        $result['apartments'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewHouses(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM `houses` h left join `apartments` a on h.apartment_id = a.id WHERE h.`landlord_id` = '$landlord_id' OR h.caretaker_id = '$landlord_id'";
        $result['houses'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewCareTakers(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM users WHERE `role` = 'caretaker' AND `landlord_id` = '$landlord_id'";
        $result['caretakers'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewInvoices(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM payments WHERE `landlord_id` = '$landlord_id' OR caretaker_id = '$landlord_id'";
        $result['payments'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewTenants(int $landlord_id)
    {
        $conn = $this->Connect();

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("
        SELECT * FROM users u
        LEFT JOIN apartments a ON u.apartment_id = a.id
        LEFT JOIN houses h ON u.house_id = h.house_id
        WHERE u.role = 'tenant' AND (u.landlord_id = ? OR u.caretaker_id = ?)
    ");

        if (!$stmt) {
            throw new Exception("SQL preparation failed: " . $conn->error);
        }

        $stmt->bind_param("ii", $landlord_id, $landlord_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $tenants = $result->fetch_all(MYSQLI_ASSOC);

        return ["tenants" => $tenants];
    }




    // Add methods matching your database schema
    public function addApartment($apartment_name, $address, $rent_amount, $landlord_id, $caretaker_id)
    {
        $conn = $this->Connect();
        $status = 'vacant'; // Default status

        $stmt = $conn->prepare("INSERT INTO apartments (landlord_id, apartment_name, caretaker_id, address, rent_amount, status) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isisdss", $landlord_id, $apartment_name, $caretaker_id, $address, $rent_amount, $status);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Apartment added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding apartment: " . $stmt->error];
        }
    }

    public function addHouse($house_no, $apartment_id, $landlord_id, $caretaker_id, $rent_amount)
    {
        $conn = $this->Connect();
        $date_added = date('Y-m-d');
        $house_status = 'vacant'; // Default status

        $stmt = $conn->prepare("INSERT INTO houses (house_no, apartment_id, landlord_id, caretaker_id, date_added, rent_amount, house_status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiisdss", $house_no, $apartment_id, $landlord_id, $caretaker_id, $date_added, $rent_amount, $house_status);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "House added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding house: " . $stmt->error];
        }
    }

    public function addTenant($name, $email, $phone, $password, $apartment_id, $house_id, $move_in_date, $landlord_id, $caretaker_id)
    {
        $conn = $this->Connect();

        // First add to users table
        $role = 'tenant';
        $user_status = 'active';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role, landlord_id, caretaker_id, apartment_id, house_id, user_status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiiss", $name, $email, $phone, $hashed_password, $role, $landlord_id, $caretaker_id, $apartment_id, $house_id, $user_status);

        if (!$stmt->execute()) {
            return ["success" => false, "message" => "Error adding tenant user: " . $stmt->error];
        }

        $user_id = $stmt->insert_id;

        // Then add to tenants table
        $stmt = $conn->prepare("INSERT INTO tenants (apartment_id, house_id, user_id, move_in_date) 
                               VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $apartment_id, $house_id, $user_id, $move_in_date);

        if ($stmt->execute()) {
            // Update house status to occupied
            $this->updateHouseStatus($house_id, 'occupied');
            return ["success" => true, "message" => "Tenant added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding tenant record: " . $stmt->error];
        }
    }

    private function updateHouseStatus($house_id, $status)
    {
        $conn = $this->Connect();
        $stmt = $conn->prepare("UPDATE houses SET house_status = ? WHERE house_id = ?");
        $stmt->bind_param("si", $status, $house_id);
        return $stmt->execute();
    }

    public function addCaretaker($name, $email, $phone, $password, $assigned_apartment_id, $landlord_id)
    {
        $conn = $this->Connect();
        $landlord_id = $_SESSION["user_id"];
        // First add to users table
        $role = 'caretaker';
        $user_status = 'active';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role, landlord_id, apartment_id, user_status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssiis", $name, $email, $phone, $hashed_password, $role, $landlord_id, $assigned_apartment_id, $user_status);

        if (!$stmt->execute()) {
            return ["success" => false, "message" => "Error adding caretaker user: " . $stmt->error];
        }

        $user_id = $stmt->insert_id;

        // Then add to caretakers table
        $hired_date = date('Y-m-d');
        $stmt = $conn->prepare("INSERT INTO caretakers (user_id, assigned_apartment_id, hired_date) 
                               VALUES (?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $assigned_apartment_id, $hired_date);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Caretaker added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding caretaker record: " . $stmt->error];
        }
    }

    public function addPayment($tenant_id, $apartment_id, $landlord_id, $caretaker_id, $amount, $payment_date, $status)
    {
        $conn = $this->Connect();

        $stmt = $conn->prepare("INSERT INTO payments (tenant_id, apartment_id, landlord_id, caretaker_id, amount, payment_date, status) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiidss", $tenant_id, $apartment_id, $landlord_id, $caretaker_id, $amount, $payment_date, $status);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Payment added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding payment: " . $stmt->error];
        }
    }

    public function addMaintenance($apartment_id, $tenant_id, $caretaker_id, $description, $status)
    {
        $conn = $this->Connect();

        $stmt = $conn->prepare("INSERT INTO maintenance (apartment_id, tenant_id, caretaker_id, description, status) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $apartment_id, $tenant_id, $caretaker_id, $description, $status);

        if ($stmt->execute()) {
            return ["success" => true, "message" => "Maintenance request added successfully"];
        } else {
            return ["success" => false, "message" => "Error adding maintenance request: " . $stmt->error];
        }
    }
}
