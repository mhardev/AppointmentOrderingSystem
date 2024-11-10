<!-- HEADER -->
<div class="modal fade modal-md" id="headerCP" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="password" id="CurPass" class="form-control" placeholder="Current Password" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="password" id="newPass" class="form-control" placeholder="New Password" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="password" id="confirmPass" class="form-control" placeholder="Confirm Password" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="changePass">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="updateProfile" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile Pic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="file" id="updateImage" class="form-control" placeholder="" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updtPicBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="updateInfo" tabindex="-1" aria-labelledby="updateMdlLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Update Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display: none;">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="accId" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="Email" placeholder="Email" aria-label="Stock" aria-describedby="basic-addon1" required>
                                    <label for="Email">Email address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="Age" placeholder="Age" aria-label="Image" aria-describedby="basic-addon1" required>
                                    <label for="Age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="Address" placeholder="Address" id="Address"></textarea>
                                    <label for="Address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+63</span>
                                    <input type="text" class="form-control" id="Number" placeholder="9123456789" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updtAcc">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="verifModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body" style="border-width : 0">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <span>Are you sure to change your password?</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="submitCode">Yes</button>
            </div>
        </div>
    </div>
</div>

<!-- SUPPLIERS -->
<div class="modal fade modal-md" id="addSupp" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Add Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <label for="shopName">Supplier Shop Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="ShopName" class="form-control" placeholder="Enter shop name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label for="suppAdd">Supplier Address</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="SuppAdd" class="form-control" placeholder="Enter address" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <label for="suppNum">Supplier Contact Number</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="SuppNum" class="form-control" placeholder="Enter contact number" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label for="suppPerson">Supplier Contact Person</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="SuppPerson" class="form-control" placeholder="Enter contact person" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addSuppBtn">Add Supplier</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-md" id="addProd" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display:none">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="suppId" class="form-control" placeholder="Product Name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label for="prodName">Product Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="prodName" class="form-control" placeholder="Enter product name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label for="prodPrice">Product Price</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="prodPrice" class="form-control" placeholder="Enter price" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <label for="prodFile">Upload Image</label>
                                <div class="input-group mb-3">
                                    <input type="file" id="prodFile" class="form-control" placeholder="Upload an image" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <label for="prodCat">Category</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="prodCat" class="form-control" placeholder="Enter category" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <label for="prodStock">Stock</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="prodStock" class="form-control" placeholder="Enter stock" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProdCfrm">Add Product</button>
            </div>
        </div>
    </div>
</div>

<!-- Appointments -->
<div class="modal fade modal-md" id="updtApp" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Update Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display:none">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="hidden" id="appId" class="form-control" placeholder="Product Name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mt-3 mb-2">
                                    <select class="form-select" id="appStatus" aria-label="Floating label select example">
                                        <option value="" selected>-- Update Status --</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Cancelled</option>
                                        <option value="3">Not Paid</option>
                                        <option value="4">Complete</option>
                                    </select>
                                    <label for="appStatus">Appointment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Product Order -->
<div class="modal fade modal-md" id="updtOrder" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Update Product Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display:none">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="orderId" class="form-control" placeholder="Product Name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mt-3 mb-2">
                                    <select class="form-select" id="orderStatus" aria-label="Floating label select example">
                                        <option value="" selected>-- Update Status --</option>
                                        <option value="1">Cancelled</option>
                                        <option value="2">For Pickup</option>
                                        <option value="3">Complete</option>
                                    </select>
                                    <label for="appStatus">Appointment</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-md" id="viewOrder" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="form-floating">
                                    <textarea class="form-control" id="prodOrder" style="height: 100px" readonly></textarea>
                                    <label for="prodOrder">Products Ordered</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Admin Accounts -->
<div class="modal fade modal-md" id="addAcc" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Add Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="user" class="form-control" placeholder="Username" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="email" id="email" class="form-control" placeholder="Email" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="password" id="pass" class="form-control" placeholder="Password" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="address" class="form-control" placeholder="Address" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="number" id="age" class="form-control" placeholder="Age" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="number" class="form-control" placeholder="9123456789" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="file" id="image" class="form-control" placeholder="Image" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addConfirm">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteAcc" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="dltConfirm">Yes, proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Services -->
<div class="modal fade modal-md" id="addService" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" id="ServName" class="form-control" placeholder="Service Name" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="number" id="ServPrice" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="ServAdd">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="updateService" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Order Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display: none;">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="servId" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="servName" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="int" class="form-control" id="servPrice" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updtServ">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Products -->
<div class="modal fade modal-md" id="orderStock" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Order Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="display: none;">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="prodId" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box charts-card">
                                <div class="form-floating mt-3 mb-2">
                                    <select class="form-select" id="suppliers" aria-label="Floating label select example">
                                        <option selected>Select Supplier</option>
                                    </select>
                                    <label for="suppliers">Suppliers</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box charts-card">
                                <div class="form-floating mt-3 mb-2">
                                    <select class="form-select" id="products" aria-label="Floating label select example">
                                        <option selected>Select Products</option>
                                    </select>
                                    <label for="products">Products</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="number" id="orderQuant" class="form-control" placeholder="Quantity" aria-label="Quantity" aria-describedby="basic-addon1">
                                    <label for="orderQuant">Order Quantity</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="number" id="suppProdStock" class="form-control" placeholder="Stock" aria-label="Stock" aria-describedby="basic-addon1">
                                    <label for="suppProdStock">Stock</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="number" id="suppProdPrice" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1" readonly>
                                    <label for="suppProdPrice">Price</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <input type="text" id="suppProdCat" class="form-control" placeholder="Price" aria-label="Price" aria-describedby="basic-addon1" readonly>
                                    <label for="suppProdCat">Category</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="box">
                                <div class="form-floating mb-3">
                                    <img src="" class="img-thumbnail" alt="product" id="prodImage" style="height: 100px; width:100px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="orderCnfrm">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-md" id="addProdStock" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">>
    <div class="modal-dialog h-50">
        <div class="modal-content h-80">
            <div class="modal-header">
                <h5 class="modal-title">Add Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                <small id="prodtextname"></small>
                    <div class="row">
                        <div class="col" style="display: none;">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="number" id="stockId" class="form-control" placeholder="0" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="display: none;">
                            <div class="box">
                                <div class="input-group mb-3" >
                                    <input type="text" id="prodname" class="form-control" placeholder="prod" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box">
                                <div class="input-group mb-3">
                                    <input type="number" id="stock" class="form-control" placeholder="0" aria-label="Price" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addProdStockBtn">Add</button>
            </div>
        </div>
    </div>
</div>