<!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index" style="font-weight:600;">Super admin</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo 'Admin online'; ?></div>
                    <div class="email"><?php echo "active"; ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);" data-toggle="modal" data-target="#converter"><i class="material-icons">swap_horiz</i>Dollar converter</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="?logout"><i class="material-icons">input</i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN</li>
                    <li class="active">
                        <a href="index">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">supervisor_account</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="registeredusers">
                                    <span>Registered users</span>
                                </a>
                            </li>
                            <li>
                                <a href="createuser">
                                    <span>Create user</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="deposite">
                            <i class="material-icons">credit_card</i>
                            <span>Deposit</span>
                        </a>
                    </li>
                    <li>
                        <a href="withdrawal">
                            <i class="material-icons">account_balance_wallet</i>
                            <span>Withdrawal</span>
                        </a>
                    </li>
                    <li>
                        <a href="investments">
                            <i class="material-icons">account_balance</i>
                            <span>Investments</span>
                        </a>
                    </li>
                    <li>
                        <a href="confirm">
                            <i class="material-icons">account_balance</i>
                            <span>Confirm</span>
                        </a>
                    </li>
                    <li>
                        <a href="earnings">
                            <i class="material-icons">event</i>
                            <span>Earnings</span>
                        </a>
                    </li>
                    <li class="header">ACCOUNT</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons col-green">chrome_reader_mode</i>
                            <span>Blog</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="createpost">
                                    <span>Create post</span>
                                </a>
                            </li>
                            <li>
                                <a href="viewpost">
                                    <span>View post</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="websiteinfo">
                            <i class="material-icons col-blue">assessment</i>
                            <span>Website info</span>
                        </a>
                    </li>
                    <li>
                        <a href="changepassword">
                            <i class="material-icons col-amber">lock_outline</i>
                            <span>Change password</span>
                        </a>
                    </li>
                    <li>
                        <a href="?logout">
                            <i class="material-icons col-light-blue">input</i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">Super admin</a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Small Size -->
            <div class="modal fade" id="converter" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content modal-col-teal">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">CONVERT DOLLAR TO BITCOIN</h4>
                            <small style="color: #fff;">converts from dollar to bitcoin alone</small>
                        </div>
                        <form>
                        <div class="modal-body">
                            <div class="form-group">
                                        <div class="form-line">
                                            <small>$</small>
                                            <input id="usd" placeholder="" type="text" class="form-control" data-parsley-pattern="^[0-9.]+$">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <small>BTC</small>
                                            <input id="btc" placeholder="" type="text" class="form-control" data-parsley-pattern="^[0-9.]+$">
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="convert()" class="btn btn-link waves-effect">SUBMIT</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
            function convert(){
                        var usd = document.getElementById('usd').value;
                        $.ajax({
                            type:"GET",
                            url: "https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=BTC,EUR",
                            dataType: 'text',
                            success: function(data)
                            {
                                var ret1 = data.replace('{"BTC":','');
                                var tmp1 = ret1.split(",");
                                document.getElementById('btc').value=(''+tmp1[0]*usd);
                            }
                        });
            };
            </script>
            <!-- #END# Small Size -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan" class="active">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>