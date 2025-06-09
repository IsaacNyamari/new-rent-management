<?php

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
        return $conn;
    }
}

class Apartments extends Dbh
{
    public function viewApartments()
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM apartments";
        $result['apartments'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function addApartments() {}
    public function editApartments() {}
    public function viewHouses(int $landlord_id) {
        $conn = $this->Connect();
        $sql = "SELECT * FROM `houses` h left join `apartments` a on h.apartment_id = a.id WHERE h.`landlord_id` = '$landlord_id' OR h.caretaker_id = '$landlord_id'";
        $result['houses'] = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function addHouses() {}
    public function viewWaterBills() {}
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

}
