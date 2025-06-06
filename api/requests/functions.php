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
        $result = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function addApartments() {}
    public function editApartments() {}
    public function viewHouses(int $landlord_id) {
        $conn = $this->Connect();
        $sql = "SELECT * FROM `houses` h WHERE h.`landlord_id` = '$landlord_id' OR h.caretaker_id = '$landlord_id'";
        $result = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function addHouses() {}
    public function viewWaterBills() {}
    public function viewCareTakers(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM users WHERE `role` = 'caretaker' AND `landlord_id` = '$landlord_id'";
        $result = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewInvoices(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM payments WHERE `landlord_id` = '$landlord_id' OR caretaker_id = '$landlord_id'";
        $result = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
    public function viewTenants(int $landlord_id)
    {
        $conn = $this->Connect();
        $sql = "SELECT * FROM users WHERE `role` = 'tenant' AND `landlord_id` = '$landlord_id' OR caretaker_id = '$landlord_id'";
        $result = mysqli_fetch_all($conn->query($sql), 1);
        return $result;
    }
}
