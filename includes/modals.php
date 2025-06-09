<!-- addWaterBillModal -->
<div class="modal fade" id="addWaterBillModal" tabindex="-1" aria-labelledby="addWaterBillModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addWaterBillModalLabel"><i class="fas fa-water"></i> Add Water Bill</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="waterBillForm">
                    <div class="mb-3">
                        <label for="waterBillApartment" class="form-label">Apartment</label>
                        <select class="form-select" id="waterBillApartment" required>
                            <option value="">Select Apartment</option>
                            <!-- Apartments will be populated here -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="waterBillAmount" class="form-label">Amount (Ksh)</label>
                        <input type="number" class="form-control" id="waterBillAmount" required>
                    </div>
                    <div class="mb-3">
                        <label for="waterBillPeriod" class="form-label">Billing Period</label>
                        <input type="month" class="form-control" id="waterBillPeriod" required>
                    </div>
                    <div class="mb-3">
                        <label for="waterBillDueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="waterBillDueDate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Water Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- addCaretakerModal -->

<div class="modal fade" id="addCaretakerModal" tabindex="-1" aria-labelledby="addCaretakerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addCaretakerModalLabel"><i class="fas fa-user-plus"></i> Add Caretaker</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="caretakerForm">
                    <div class="mb-3">
                        <label for="caretakerName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="caretakerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="caretakerPhone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="caretakerPhone" required>
                    </div>
                    <div class="mb-3">
                        <label for="caretakerIdNumber" class="form-label">ID Number</label>
                        <input type="text" class="form-control" id="caretakerIdNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="caretakerApartment" class="form-label">Assigned Apartment</label>
                        <select class="form-select" id="caretakerApartment" required>
                            <option value="">Select Apartment</option>
                            <!-- Apartments will be populated here -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Caretaker</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- addTenantModal -->

<div class="modal fade" id="addTenantModal" tabindex="-1" aria-labelledby="addTenantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addTenantModalLabel"><i class="fa fa-user-plus"></i> Add New Tenant</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tenantForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tenantName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="tenantName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tenantPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="tenantPhone" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tenantEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="tenantEmail">
                        </div>
                        <div class="col-md-6">
                            <label for="tenantIdNumber" class="form-label">ID Number</label>
                            <input type="text" class="form-control" id="tenantIdNumber" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tenantHouse" class="form-label">Assigned House</label>
                            <select class="form-select" id="tenantHouse" required>
                                <option value="">Select House</option>
                                <!-- Houses will be populated here -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="moveInDate" class="form-label">Move-in Date</label>
                            <input type="date" class="form-control" id="moveInDate" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- add house modal -->

<div class="modal fade" id="addHouseModal" tabindex="-1" aria-labelledby="addHouseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addHouseModalLabel"><i class="fa fa-plus-square"></i> Add New House</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="houseForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="houseNumber" class="form-label">House Number</label>
                            <input type="text" class="form-control" id="houseNumber" required>
                        </div>
                        <div class="col-md-6">
                            <label for="houseApartment" class="form-label">Apartment</label>
                            <select class="form-select" id="houseApartment" required>
                                <option value="">Select Apartment</option>
                                <!-- Apartments will be populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="houseType" class="form-label">House Type</label>
                            <select class="form-select" id="houseType" required>
                                <option value="">Select Type</option>
                                <option value="1 Bedroom">1 Bedroom</option>
                                <option value="2 Bedroom">2 Bedroom</option>
                                <option value="3 Bedroom">3 Bedroom</option>
                                <option value="Studio">Studio</option>
                                <option value="Bedsitter">Bedsitter</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="monthlyRent" class="form-label">Monthly Rent (Ksh)</label>
                            <input type="number" class="form-control" id="monthlyRent" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save House</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- add house modal -->

<div class="modal fade" id="addApartmentModal" tabindex="-1" aria-labelledby="addApartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addApartmentModalLabel"><i class="fa fa-plus-circle"></i> Add New Apartment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="apartmentForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="apartmentName" class="form-label">Apartment Name</label>
                            <input type="text" class="form-control" id="apartmentName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apartmentLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="apartmentLocation" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="totalUnits" class="form-label">Total Units</label>
                            <input type="number" class="form-control" id="totalUnits" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apartmentCaretaker" class="form-label">Caretaker</label>
                            <select class="form-select" id="apartmentCaretaker">
                                <option value="">Select Caretaker</option>
                                <!-- Caretakers will be populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Apartment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>