<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Management</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <style>
    .car-management-panel {
      background: #ffffff;
      border-radius: 15px;
      padding: 2rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
      margin: 2rem;
    }

    .panel-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .panel-title {
      font-size: 1.5rem;
      color: #1a1a1a;
      font-weight: 600;
    }

    .add-car-btn {
      background: #6366f1;
      color: white;
      padding: 0.8rem 1.5rem;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: transform 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .add-car-btn:hover {
      transform: translateY(-2px);
      background: #4f46e5;
    }

    .car-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1.5rem;
    }

    .car-card {
      background: #fff;
      border-radius: 12px;
      padding: 1.5rem;
      border: 1px solid #e5e7eb;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .car-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.05);
    }

    .car-thumbnail {
      width: 100%;
      height: 180px;
      border-radius: 8px;
      object-fit: cover;
      margin-bottom: 1rem;
    }

    .car-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .car-details {
      display: flex;
      flex-wrap: wrap;
      gap: 0.8rem;
      margin-bottom: 1rem;
    }

    .car-detail {
      background: #f8fafc;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.9rem;
      color: #64748b;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .car-status {
      position: absolute;
      top: 1rem;
      right: 1rem;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
    }

    .status-available {
      background: #dcfce7;
      color: #16a34a;
    }

    .status-booked {
      background: #fef9c3;
      color: #ca8a04;
    }

    .status-maintenance {
      background: #fee2e2;
      color: #dc2626;
    }

    .car-actions {
      display: flex;
      gap: 0.8rem;
      margin-top: 1rem;
    }

    .action-btn {
      padding: 0.5rem 1rem;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      transition: all 0.2s;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .edit-btn {
      background: #e0e7ff;
      color: #4f46e5;
    }

    .edit-btn:hover {
      background: #c7d2fe;
    }

    .delete-btn {
      background: #fee2e2;
      color: #dc2626;
    }

    .delete-btn:hover {
      background: #fecaca;
    }

    /* Search and Filter Styles */
    .filter-section {
      margin-bottom: 2rem;
      background: #f8fafc;
      padding: 1.5rem;
      border-radius: 12px;
      border: 1px solid #e5e7eb;
    }

    .search-bar {
      position: relative;
      margin-bottom: 1rem;
    }

    .search-bar i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
    }

    .search-bar input {
      width: 90%;
      padding: 0.8rem 1rem 0.8rem 2.5rem;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s;
    }

    .search-bar input:focus {
      outline: none;
      border-color: #6366f1;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .filter-controls {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
    }

    .filter-dropdown {
      position: relative;
      min-width: 180px;
    }

    .filter-dropdown select {
      width: 100%;
      padding: 0.8rem 2rem 0.8rem 1rem;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      appearance: none;
      background: white;
      color: #1f2937;
      font-size: 0.95rem;
      cursor: pointer;
    }

    .filter-dropdown i {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      pointer-events: none;
      color: #64748b;
    }

    .filter-btn {
      background: #e0e7ff;
      color: #4f46e5;
      padding: 0.8rem 1.2rem;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: all 0.2s;
    }

    .filter-btn:hover {
      background: #c7d2fe;
    }

    @media (max-width: 768px) {
      .filter-controls {
        flex-direction: column;
      }

      .filter-dropdown {
        width: 100%;
      }

      .filter-btn {
        width: 100%;
        justify-content: center;
      }
    }
  </style>


  <style>
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
    }

    .modal-content {
      background: white;
      margin: 2% auto;
      width: 80%;
      max-width: 900px;
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
      padding: 20px;
      border-bottom: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h2 {
      margin: 0;
      color: #1a1a1a;
    }

    .close {
      font-size: 28px;
      cursor: pointer;
      color: #666;
    }

    .close:hover {
      color: #333;
    }

    .modal-body {
      padding: 20px;
      max-height: 70vh;
      overflow-y: auto;
    }

    .form-columns {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .form-section {
      margin-bottom: 25px;
    }

    .form-section h3 {
      color: #333;
      font-size: 1.1rem;
      margin: 0 0 15px 0;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: #444;
      font-size: 0.9rem;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
      outline: none;
      border-color: #6366f1;
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .required {
      color: #ef4444;
    }

    .form-actions {
      margin-top: 25px;
      text-align: right;
      display: flex;
      gap: 10px;
      justify-content: flex-end;
    }

    .submit-btn,
    .cancel-btn {
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.2s;
    }

    .submit-btn {
      background: #6366f1;
      color: white;
    }

    .submit-btn:hover {
      background: #4f46e5;
    }

    .cancel-btn {
      background: #f3f4f6;
      color: #444;
    }

    .cancel-btn:hover {
      background: #e5e7eb;
    }

    @media (max-width: 768px) {
      .modal-content {
        width: 95%;
        margin: 10px auto;
      }

      .form-columns {
        grid-template-columns: 1fr;
      }
    }

    /* File Input Styling */
    input[type="file"] {
      padding: 8px;
      background: #f8f9fa;
      border: 1px dashed #ddd;
    }

    input[type="file"]::file-selector-button {
      background: #6366f1;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 4px;
      margin-right: 10px;
      cursor: pointer;
      transition: background 0.2s;
    }

    input[type="file"]::file-selector-button:hover {
      background: #4f46e5;
    }

    /* Additional Select Styling */
    select {
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      background-size: 1em;
    }

    .toast {
      position: fixed;
      bottom: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 500;
      z-index: 1000;
      animation: slideIn 0.3s ease-out;
    }

    .toast.success {
      background: #22c55e;
    }

    .toast.error {
      background: #ef4444;
    }

    .toast.info {
      background: #3b82f6;
    }

    @keyframes slideIn {
      from {
        transform: translateX(100%);
      }

      to {
        transform: translateX(0);
      }
    }
  </style>


</head>

<body>
  <div style="display: flex;">
    <div style="width: 20%; ">
      <?php
      include_once("layouts/sidebar.php");
      ?>
    </div>
    <div style="width: 80%;">


      <div class="car-management-panel">
        <div class="panel-header">
          <h2 class="panel-title">Vehicle Inventory</h2>
          <button class="add-car-btn">
            <i class="fas fa-plus"></i>
            Add New Car
          </button>
        </div>

        <!-- Search and Filter Section -->
        <div class="filter-section">
          <div class="search-bar">
            <i class="fas fa-search"></i>
            <input
              type="text"
              placeholder="Search cars by model, VIN, or features..." />
          </div>

          <div class="filter-controls">
            <div class="filter-dropdown">
              <select>
                <option value="">All Statuses</option>
                <option value="available">Available</option>
                <option value="booked">Booked</option>
                <option value="maintenance">Maintenance</option>
              </select>
              <i class="fas fa-chevron-down"></i>
            </div>

            <div class="filter-dropdown">
              <select>
                <option value="">All Types</option>
                <option value="2">SUV</option>
                <option value="1">Sedan</option>
                <option value="4">Coupe</option>
              </select>
              <i class="fas fa-chevron-down"></i>
            </div>

            <button class="filter-btn">
              <i class="fas fa-sliders-h"></i>
              Advanced Filters
            </button>
          </div>
        </div>

        <div class="car-grid">


        </div>

      </div>
    </div>
  </div>


  <!-- Add this modal HTML at the end of body -->
  <div id="carModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Add New Vehicle</h2>
        <span class="close">&times;</span>
      </div>

      <form id="carForm" class="modal-body" enctype="multipart/form-data">
        <div class="form-columns">
          <!-- Basic Information Column -->
          <div class="form-section">
            <h3>Basic Information</h3>
            <div class="form-group">
              <label>Name <span class="required">*</span></label>
              <input type="text" name="name" required>
            </div>
            <div class="form-group">
              <label>Make <span class="required">*</span></label>
              <input type="text" name="make" required>
            </div>
            <div class="form-group">
              <label>Model <span class="required">*</span></label>
              <input type="text" name="model" required>
            </div>
            <div class="form-group">
              <label>Registration Year <span class="required">*</span></label>
              <input type="number" name="regYear" min="1900" max="2024" required>
            </div>
            <div class="form-group">
              <label>Manufacture Year <span class="required">*</span></label>
              <input type="number" name="makeYear" min="1900" max="2024" required>
            </div>
          </div>

          <!-- Technical Specifications -->
          <div class="form-section">
            <h3>Technical Specs</h3>
            <div class="form-group">
              <label>Fuel Type <span class="required">*</span></label>
              <select name="fuelType" required>
                <option value="Petrol">Petrol</option>
                <option value="Diesel">Diesel</option>
                <option value="Electric">Electric</option>
                <option value="CNG">CNG</option>
              </select>
            </div>
            <div class="form-group">
              <label>Transmission <span class="required">*</span></label>
              <select name="transmission" required>
                <option value="Automatic">Automatic</option>
                <option value="Manual">Manual</option>
              </select>
            </div>
            <div class="form-group">
              <label>Body Type <span class="required">*</span></label>
              <select name="bodytype" required>
                <option value="">All Types</option>
                <option value="2">SUV</option>
                <option value="1">Sedan</option>
                <option value="4">Coupe</option>
              </select>
            </div>
            <div class="form-group">
              <label>Engine CC</label>
              <input type="number" name="engine" min="0">
            </div>
            <div class="form-group">
              <label>Kilometers <span class="required">*</span></label>
              <input type="number" name="kms" min="0" required>
            </div>
          </div>

          <!-- Pricing & Ownership -->
          <div class="form-section">
            <h3>Pricing & Ownership</h3>
            <div class="form-group">
              <label>Price (₹) <span class="required">*</span></label>
              <input type="number" name="price" min="0" required>
            </div>
            <div class="form-group">
              <label>Discounted Price (₹)</label>
              <input type="number" name="discountedPrice" min="0">
            </div>
            <div class="form-group">
              <label>EMI (₹)</label>
              <input type="number" name="emi" min="0">
            </div>
            <div class="form-group">
              <label>Other Charges (₹)</label>
              <input type="number" name="otherCharges" min="0">
            </div>
            <div class="form-group">
              <label>Owner <span class="required">*</span></label>
              <input type="text" name="owner" required>
            </div>
          </div>

          <!-- Additional Details -->
          <div class="form-section">
            <h3>Additional Information</h3>
            <div class="form-group">
              <label>Registration Number</label>
              <input type="text" name="regNo">
            </div>
            <div class="form-group">
              <label>Insurance Details</label>
              <input type="text" name="insurance">
            </div>
            <div class="form-group">
              <label>Location</label>
              <input type="text" name="location">
            </div>
            <div class="form-group">
              <label>Spare Key</label>
              <select name="sparekey">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="form-group">
              <label>Alloy Wheels</label>
              <select name="alloywheels">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="form-group">
              <label>City Driven</label>
              <select name="citydriven">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
            </div>
            <div class="form-group">
              <label>Car Condition <span class="required">*</span></label>
              <select name="carcondition" required>
                <option value="New">New</option>
                <option value="Used">Used</option>
                <option value="Refurbished">Refurbished</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Bottom Section -->
        <div class="form-section full-width">
          <div class="form-group">
            <label>Safety Features (SSF)</label>
            <textarea name="ssf" rows="2" placeholder="ABS, Airbags, ESP..."></textarea>
          </div>
          <div class="form-group">
            <label>Car Description</label>
            <textarea name="cardesc" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label>Vehicle Image <span class="required">*</span></label>
            <input type="file" name="image" accept="image/*" required>
          </div>
        </div>

        <div class="form-actions">
          <button type="button" class="cancel-btn">Cancel</button>
          <button type="submit" class="submit-btn">Add Vehicle</button>
        </div>
      </form>
    </div>
  </div>




</body>


<script>
  // Modal handling
  const modal = document.getElementById('carModal');
  const addBtn = document.querySelector('.add-car-btn');
  const span = document.querySelector('.close');
  const cancelBtn = document.querySelector('.cancel-btn');

  addBtn.onclick = () => modal.style.display = 'block';
  span.onclick = () => modal.style.display = 'none';
  cancelBtn.onclick = () => modal.style.display = 'none';

  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  }


  // Update the form submission handler
  document.getElementById('carForm').addEventListener('submit', async (e) => {


    // const submitBtn = form.querySelector('.submit-btn');
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    console.log('FormData entries:');
    for (let [key, value] of formData.entries()) {
      console.log(key, value);
    }

    $.ajax({
      url: "save_car.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 10000, // 10 seconds timeout
      success: function(res, status, xhr) {
        console.log('Raw Server Response:', res);
        console.log('Content-Type:', xhr.getResponseHeader('Content-Type'));

        try {
          const response = typeof res === 'string' ? JSON.parse(res) : res;
          if (response.success) {
            alert('Success: ' + response.message);
            form.reset();
            window.location.reload();
          } else {
            alert('Error: ' + (response.message || 'Unknown error'));
          }
        } catch (e) {
          console.error('Invalid JSON Response:', res);
          alert('Invalid server response format');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error:', status, error);
        console.log('Response Text:', xhr.responseText);
        alert('Request failed: ' + error);
      },
      complete: function() {
        $('.submit-btn').prop('disabled', false)
          .html('Add Vehicle');
      }
    });

  });

  // Toast notification function
  function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => toast.remove(), 3000);
  }
</script>


<script>
  $(document).ready(function() {

    $.ajax({
      url: "functions.php",
      type: "POST",
      data: {
        "RESULT_TYPE": "GET_CAR_INVENTORY",
      },
      success: function(res) {
        var jobj = JSON.parse(res)
        for (var i = 0; i < jobj.length; i++) {
          // Example usage
          const carData = {
            status: 'available',
            imageUrl: "../img/" + jobj[i].image,
            title: jobj[i].name,
            year: jobj[i].regYear,
            mileage: jobj[i].kms,
            fuelType: jobj[i].fuelType,
            transmission: jobj[i].transmission
          };
          const newCarCard = createCarCard(carData);
          // Add to DOM (make sure you have a container with class 'car-grid')
          document.querySelector('.car-grid').appendChild(newCarCard);

        }


      }
    });
  });



  // Create car card element
  function createCarCard(carData) {
    // Main card container
    const carCard = document.createElement('div');
    carCard.className = 'car-card';

    // Status badge
    const status = document.createElement('span');
    status.className = `car-status status-${carData.status}`;
    status.textContent = carData.status;

    // Thumbnail image
    const img = document.createElement('img');
    img.className = 'car-thumbnail';
    img.src = carData.imageUrl;
    img.alt = 'Car';

    // Title
    const title = document.createElement('h3');
    title.className = 'car-title';
    title.textContent = carData.title;

    // Details container
    const details = document.createElement('div');
    details.className = 'car-details';

    // Detail items
    const detailsData = [{
        icon: 'fas fa-calendar-alt',
        text: carData.year
      },
      {
        icon: 'fas fa-tachometer-alt',
        text: carData.mileage
      },
      {
        icon: 'fas fa-gas-pump',
        text: carData.fuelType
      },
      {
        icon: 'fas fa-car',
        text: carData.transmission
      }
    ];

    detailsData.forEach(detail => {
      const span = document.createElement('span');
      span.className = 'car-detail';

      const icon = document.createElement('i');
      icon.className = detail.icon;

      span.appendChild(icon);
      span.appendChild(document.createTextNode(detail.text));
      details.appendChild(span);
    });

    // Action buttons
    const actions = document.createElement('div');
    actions.className = 'car-actions';

    const editBtn = document.createElement('button');
    editBtn.className = 'action-btn edit-btn';
    editBtn.innerHTML = '<i class="fas fa-edit"></i> Edit';

    const deleteBtn = document.createElement('button');
    deleteBtn.className = 'action-btn delete-btn';
    deleteBtn.innerHTML = '<i class="fas fa-trash"></i> Delete';

    actions.append(editBtn, deleteBtn);

    // Assemble the card
    carCard.append(status, img, title, details, actions);

    return carCard;
  }
</script>

</html>