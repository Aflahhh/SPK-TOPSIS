<style>
    .notification-box {
        position: absolute;
        top: 2.8em;
        left: -10em;
        width: 300px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 999;
    }

    .notification-item {
        padding: 10px 15px;
        border-bottom: 1px solid #eee;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .title-notif {
        padding: 15px;
        text-align: center;
    }

    /* Custom badge styling for notifications */
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 0.6em;
        min-width: 1.5em;
        min-height: 1.5em;
        line-height: 1.5;
        text-align: center;
    }

    .rounded-circle {
        border-radius: 50%;
    }
</style>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Kepegawaian</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            {{-- notif --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link position-relative" id="notification-icon">
                    <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
                    <span id="notification-count" class="badge rounded-circle position-absolute top-72 start-150 translate-middle bg-primary text-white">
                        0
                    </span>
                </a>
                <div id="notification-box" class="notification-box" style="display: none;">
                    <p class="title-notif"><strong>Pegawai Akan Pensiun</strong></p>
                    <hr>
                    <div id="notification-content">
                        <p style="text-align: center; margin: 5px;">Loading notifications...</p>
                    </div>
                </div>
            </div>
            
            
            {{-- end notif --}}
            

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span
                        class="d-none d-md-block dropdown-toggle ps-2 text-uppercase">{{ Auth::user()->username }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>Kevin Anderson</h6>
                        <span>Web Designer</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Load notifications from the server
        function loadNotifications() {
            $.ajax({
                url: '{{ route('notifications') }}', // Ganti URL ini sesuai endpoint Anda
                method: 'GET',
                success: function (response) {
                    const notificationCount = response.count;
                    const notificationContent = $('#notification-content');

                    // Update notification count
                    $('#notification-count').text(notificationCount);

                    // Clear existing content
                    notificationContent.empty();

                    if (notificationCount > 0) {
                        // Populate notifications
                        $.each(response.details, function (key, detail) {
                            const item = `
                                <div class="notification-item">
                                    <strong>${detail.nama_pegawai}</strong><br>
                                    <span>${detail.jabatan}</span>
                                </div>
                            `;
                            notificationContent.append(item);
                        });
                    } else {
                        notificationContent.html('<p style="text-align: center; margin: 10px;">No notifications</p>');
                    }
                },
                error: function () {
                    $('#notification-content').html('<p style="text-align: center; margin: 10px;">Failed to load notifications</p>');
                }
            });
        }

        // Toggle notification box
        $('#notification-icon').on('click', function (e) {
            e.preventDefault();
            $('#notification-box').toggle();
        });

        // Close notification box when clicking outside
        $(document).on('click', function (e) {
            const notificationBox = $('#notification-box');
            const notificationIcon = $('#notification-icon');

            // Check if the click is outside the notification box and icon
            if (!notificationBox.is(e.target) && notificationBox.has(e.target).length === 0 &&
                !notificationIcon.is(e.target) && notificationIcon.has(e.target).length === 0) {
                notificationBox.hide();
            }
        });

        // Load notifications on page load
        loadNotifications();
    });
</script>





