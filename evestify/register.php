<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign Up - Evestify</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="account/vendors/feather/feather.css">
    <link rel="stylesheet" href="account/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="account/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="account/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.svg" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .input-icon select,
        .input-icon input {
            padding-left: 30px;
            /* Adjust based on icon size */
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0" style="background-image: url('images/bg-reg.jpg'); background-repeat: repeat; background-size: auto;">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <a href="index.html"><img src="images/logo.svg" alt="logo"></a>
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>

                            <form id="registrationForm" class="registration-form" action="evestify_auth/register.php" method="POST" enctype="multipart/form-data">
                                <!--<h2>Register</h2>-->
                                <div class="form-group input-icon">
                                    <input type="text" class="form-control form-control-lg" name="fullname" placeholder="Full Name" required>
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" required>
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="text" class="form-control form-control-lg" name="phone" placeholder="Phone Number" required>
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <select class="form-control form-control-lg" name="country" required>
                                        <option value="" disabled selected>Country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cabo Verde">Cabo Verde</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                        <option value="Congo, Republic of the">Congo, Republic of the</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Eswatini">Eswatini</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, North">Korea, North</option>
                                        <option value="Korea, South">Korea, South</option>
                                        <option value="Kosovo">Kosovo</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia">Micronesia</option>
                                        <option value="Moldova">Moldova</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="North Macedonia">North Macedonia</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestine">Palestine</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russia">Russia</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syria">Syria</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania">Tanzania</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-Leste">Timor-Leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Vatican City">Vatican City</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Vietnam">Vietnam</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="date" class="form-control form-control-lg" placeholder="Date of birth" name="dob" required>
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required>
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                                    <i class="fas fa-lock"></i>
                                    <small class="tooltip">At least 8 characters</small>
                                    <div class="password-strength" id="passwordStrength">
                                        <span></span><span></span><span></span><span></span><span></span>
                                    </div>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="password" id="confirmPassword" class="form-control form-control-lg" name="confirm_password" placeholder="Confirm Password" required>
                                    <i class="fas fa-lock"></i>
                                    <small id="passwordMatchInfo" class="text-danger" style="display:none;">Passwords do not match</small>
                                </div>
                                <div class="form-group input-icon">
                                    <input type="text" class="form-control form-control-lg" name="referral_code" placeholder="Referral Code (Optional)">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <select class="form-control form-control-lg" name="currency" required>
                                        <option value="" disabled selected>Currency Preference</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="GBP">GBP</option>
                                    </select>
                                    <i class="fas fa-dollar"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <select class="form-control form-control-lg" name="investment_goal" required>
                                        <option value="" disabled selected>Investment Goal</option>
                                        <option value="Short Term">Short Term</option>
                                        <option value="Long Term">Long Term</option>
                                        <option value="Passive Income">Passive Income</option>
                                    </select>
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="form-group input-icon">
                                    <label>Upload ID</label>
                                    <input type="file" id="uploadID" class="form-control form-control-lg" name="upload_id" required>
                                    <i class="fas fa-passport"></i>
                                </div>
                                <div id="uploadIDPreview" style="display: none;"></div>
                                <div class="form-group input-icon">
                                    <label>Address</label>
                                    <input type="text" class="form-control form-control-lg" name="proof_of_address" placeholder="address" required>
                                    <i class="fas fa-map"></i>
                                </div>
                                <div class="form-check mb-4">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-control form-control-lg" name="agree_terms" required> I agree to all Terms & Conditions
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-4">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-control form-control-lg" name="enable_2fa"> Enable Two-Factor Authentication
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="login.php" class="text-primary">Sign In</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="account/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="account/js/off-canvas.js"></script>
    <script src="account/js/hoverable-collapse.js"></script>
    <script src="account/js/template.js"></script>
    <script src="account/js/settings.js"></script>
    <script src="account/js/todolist.js"></script>
    <!-- endinject -->
    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const passwordMatchInfo = document.getElementById('passwordMatchInfo');
        const passwordStrength = document.getElementById('passwordStrength');
        const strengthBars = passwordStrength.querySelectorAll('span');
        const uploadID = document.getElementById('uploadID');
        const uploadIDPreview = document.getElementById('uploadIDPreview');

        password.addEventListener('input', () => {
            const strength = getPasswordStrength(password.value);
            updateStrengthBars(strength);
        });

        confirmPassword.addEventListener('input', () => {
            if (password.value !== confirmPassword.value) {
                passwordMatchInfo.style.display = 'block';
            } else {
                passwordMatchInfo.style.display = 'none';
            }
        });

        uploadID.addEventListener('change', (event) => {
            showFilePreview(event.target, uploadIDPreview);
        });

        proofOfAddress.addEventListener('change', (event) => {
            showFilePreview(event.target, proofOfAddressPreview);
        });

        function getPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[@$!%*?&#]/.test(password)) strength++;
            return strength;
        }

        function updateStrengthBars(strength) {
            strengthBars.forEach((bar, index) => {
                if (index < strength) {
                    bar.classList.add('strong');
                } else {
                    bar.classList.remove('strong');
                }
            });
        }

        function showFilePreview(input, previewElement) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewElement.innerHTML = `<p>Uploaded File:</p><img src="${e.target.result}" alt="Preview" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">`;
                    previewElement.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>