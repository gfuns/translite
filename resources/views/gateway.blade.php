<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<style>
    body {
        background-color: #fff;
    }

    .gateway {
        margin-top:110px;
    }

    .container {
        width: 630px;
        background: white;
        border-radius: 5px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        margin-bottom:30px;
    }

    .sidebar {
        background-color: rgb(236, 242, 255);
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        padding: 0px;
    }

    .list-group {
        margin-top: 49.5px;
    }

    .list-group-item {
        cursor: pointer;
        border: none;
        background-color: rgb(236, 242, 255);
        /* padding: 15px; */
        padding-top: 10px;
        border-bottom: 1px solid #e2e8f0 !important;
        text-decoration: none;
        border-radius: 0px !important;
        font-size: 12px;
        color: rgb(102, 112, 133);
        font-weight: 450;
        display: flex;
        align-items: center;
        justify-content: space-between;

    }


    .list-group-item.active {
        background-color: #fff;
        color: rgb(102, 112, 133);
    }

    .list-group-item:hover {
        background-color: #fff;
        color: rgb(102, 112, 133);
    }

    .payment-form {
        background: white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        padding: 0px 0px 70px 0px;
        margin: 0px;
    }

    input {
        border-radius: 5px;
        padding: 10px;
    }

    .header {
        padding-top: 1.5rem !important;
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
        padding-bottom: 1rem !important;
        border-bottom: 1px solid #e2e8f0 !important;
    }

    .item-logo {
        margin-right: 10px;
    }

    .right-chevron {
        margin-left: auto;
    }
</style>

<body>

    <div class="gateway">
        <div class="container mt-5">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4 sidebar">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <span class="item-logo">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 9H22V11H2V9Z" fill="#ECF2FF"></path>
                                    <path
                                        d="M19 5H5C4.20508 5.00237 3.4434 5.31921 2.8813 5.8813C2.31921 6.4434 2.00237 7.20508 2 8V9H22V8C21.9976 7.20508 21.6808 6.4434 21.1187 5.8813C20.5566 5.31921 19.7949 5.00237 19 5ZM2 17C2.00237 17.7949 2.31921 18.5566 2.8813 19.1187C3.4434 19.6808 4.20508 19.9976 5 20H19C19.7949 19.9976 20.5566 19.6808 21.1187 19.1187C21.6808 18.5566 21.9976 17.7949 22 17V11H2V17Z"
                                        fill="#3D78F9"></path>
                                    <path
                                        d="M10 15H7C6.73478 15 6.48043 14.8946 6.29289 14.7071C6.10536 14.5196 6 14.2652 6 14C6 13.7348 6.10536 13.4804 6.29289 13.2929C6.48043 13.1054 6.73478 13 7 13H10C10.2652 13 10.5196 13.1054 10.7071 13.2929C10.8946 13.4804 11 13.7348 11 14C11 14.2652 10.8946 14.5196 10.7071 14.7071C10.5196 14.8946 10.2652 15 10 15Z"
                                        fill="#CEDDFE"></path>
                                </svg>
                            </span>
                            <span>Pay With Card</span>
                            <span class="right-chevron">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="item-logo">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 8H4C3.20459 8.00079 2.44199 8.31712 1.87956 8.87956C1.31712 9.44199 1.00079 10.2046 1 11V19C1.00079 19.7954 1.31712 20.558 1.87956 21.1204C2.44199 21.6829 3.20459 21.9992 4 22H20C20.7954 21.9992 21.558 21.6829 22.1204 21.1204C22.6829 20.558 22.9992 19.7954 23 19V11C22.9992 10.2046 22.6829 9.44199 22.1204 8.87956C21.558 8.31712 20.7954 8.00079 20 8ZM12 18C11.2044 18 10.4413 17.6839 9.87868 17.1213C9.31607 16.5587 9 15.7956 9 15C9 14.2044 9.31607 13.4413 9.87868 12.8787C10.4413 12.3161 11.2044 12 12 12C12.7956 12 13.5587 12.3161 14.1213 12.8787C14.6839 13.4413 15 14.2044 15 15C15 15.7956 14.6839 16.5587 14.1213 17.1213C13.5587 17.6839 12.7956 18 12 18Z"
                                        fill="#3D78F9"></path>
                                    <path
                                        d="M12 10C11.7348 10 11.4804 9.89464 11.2929 9.70711C11.1054 9.51957 11 9.26522 11 9V3C11 2.73478 11.1054 2.48043 11.2929 2.29289C11.4804 2.10536 11.7348 2 12 2C12.2652 2 12.5196 2.10536 12.7071 2.29289C12.8946 2.48043 13 2.73478 13 3V9C13 9.26522 12.8946 9.51957 12.7071 9.70711C12.5196 9.89464 12.2652 10 12 10Z"
                                        fill="#9EBBFC"></path>
                                    <path
                                        d="M14.2499 6.24979C14.1186 6.24992 13.9885 6.22411 13.8672 6.17383C13.7459 6.12354 13.6357 6.04978 13.5429 5.95679L11.9999 4.41379L10.4569 5.95679C10.2683 6.13894 10.0157 6.23974 9.75352 6.23746C9.49132 6.23518 9.24051 6.13001 9.0551 5.9446C8.86969 5.7592 8.76452 5.50838 8.76224 5.24619C8.75997 4.98399 8.86076 4.73139 9.04292 4.54279L11.2929 2.29279C11.4804 2.10532 11.7348 2 11.9999 2C12.2651 2 12.5194 2.10532 12.7069 2.29279L14.9569 4.54279C15.0967 4.68264 15.1919 4.8608 15.2305 5.05475C15.2691 5.24871 15.2493 5.44974 15.1736 5.63244C15.0979 5.81514 14.9698 5.9713 14.8054 6.08119C14.641 6.19107 14.4477 6.24974 14.2499 6.24979Z"
                                        fill="#9EBBFC"></path>
                                    <path
                                        d="M12 18C11.2044 18 10.4413 17.6839 9.87868 17.1213C9.31607 16.5587 9 15.7956 9 15C9 14.2044 9.31607 13.4413 9.87868 12.8787C10.4413 12.3161 11.2044 12 12 12C12.7956 12 13.5587 12.3161 14.1213 12.8787C14.6839 13.4413 15 14.2044 15 15C15 15.7956 14.6839 16.5587 14.1213 17.1213C13.5587 17.6839 12.7956 18 12 18Z"
                                        fill="#ECF2FF"></path>
                                    <path
                                        d="M6 16C6.55228 16 7 15.5523 7 15C7 14.4477 6.55228 14 6 14C5.44772 14 5 14.4477 5 15C5 15.5523 5.44772 16 6 16Z"
                                        fill="#ECF2FF"></path>
                                    <path
                                        d="M18 16C18.5523 16 19 15.5523 19 15C19 14.4477 18.5523 14 18 14C17.4477 14 17 14.4477 17 15C17 15.5523 17.4477 16 18 16Z"
                                        fill="#ECF2FF"></path>
                                </svg>
                            </span>
                            <span>Pay with Transfer</span>

                            <span class="right-chevron">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="item-logo">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z"
                                        fill="#3D78F9"></path>
                                    <path
                                        d="M18.8192 10.5804C19.2192 10.5804 19.5492 10.2504 19.5492 9.85044C19.5492 9.45044 19.2192 9.12044 18.8192 9.12044H15.2092L15.5992 5.62044C15.6392 5.22044 15.3592 4.86044 14.9492 4.81044C14.5492 4.77044 14.1892 5.05044 14.1392 5.46044L13.7292 9.12044H10.8992L11.2892 5.62044C11.3292 5.22044 11.0492 4.86044 10.6392 4.81044C10.2392 4.77044 9.87922 5.05044 9.82922 5.46044L9.42922 9.12044H5.89922C5.49922 9.12044 5.16922 9.45044 5.16922 9.85044C5.16922 10.2504 5.49922 10.5804 5.89922 10.5804H9.26922L8.94922 13.4304H5.17922C4.77922 13.4304 4.44922 13.7604 4.44922 14.1604C4.44922 14.5604 4.77922 14.8904 5.17922 14.8904H8.78922L8.39922 18.3904C8.35922 18.7904 8.63922 19.1504 9.04922 19.2004C9.07922 19.2004 9.09922 19.2004 9.12922 19.2004C9.49922 19.2004 9.80922 18.9204 9.85922 18.5504L10.2692 14.8904H13.1092L12.7192 18.3904C12.6792 18.7904 12.9592 19.1504 13.3692 19.2004C13.3992 19.2004 13.4192 19.2004 13.4492 19.2004C13.8192 19.2004 14.1292 18.9204 14.1792 18.5504L14.5892 14.8904H18.1192C18.5192 14.8904 18.8492 14.5604 18.8492 14.1604C18.8492 13.7604 18.5192 13.4304 18.1192 13.4304H14.7492L15.0692 10.5804H18.8192ZM13.2592 13.4204H10.4192L10.7392 10.5704H13.5792L13.2592 13.4204Z"
                                        fill="#CEDDFE"></path>
                                </svg>
                            </span>
                            <span>Pay with USSD</span>

                            <span class="right-chevron">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="item-logo">
                                <svg width="20" height="17" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 19V22H2V19C2 18.45 2.45 18 3 18H21C21.55 18 22 18.45 22 19Z"
                                        fill="#CEDDFE" stroke="#3D78F9" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7 11H5V18H7V11Z" fill="#3D78F9"></path>
                                    <path d="M11 11H9V18H11V11Z" fill="#3D78F9"></path>
                                    <path d="M15 11H13V18H15V11Z" fill="#3D78F9"></path>
                                    <path d="M19 11H17V18H19V11Z" fill="#3D78F9"></path>
                                    <path
                                        d="M23 22.75H1C0.59 22.75 0.25 22.41 0.25 22C0.25 21.59 0.59 21.25 1 21.25H23C23.41 21.25 23.75 21.59 23.75 22C23.75 22.41 23.41 22.75 23 22.75Z"
                                        fill="#3D78F9"></path>
                                    <path
                                        d="M21.37 5.74984L12.37 2.14984C12.17 2.06984 11.83 2.06984 11.63 2.14984L2.63 5.74984C2.28 5.88984 2 6.29984 2 6.67984V9.99984C2 10.5498 2.45 10.9998 3 10.9998H21C21.55 10.9998 22 10.5498 22 9.99984V6.67984C22 6.29984 21.72 5.88984 21.37 5.74984ZM12 8.49984C11.17 8.49984 10.5 7.82984 10.5 6.99984C10.5 6.16984 11.17 5.49984 12 5.49984C12.83 5.49984 13.5 6.16984 13.5 6.99984C13.5 7.82984 12.83 8.49984 12 8.49984Z"
                                        fill="#3D78F9"></path>
                                </svg>
                            </span>
                            <span>Pay in Bank Branch</span>

                            <span class="right-chevron">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Main Payment Form -->
                <div class="col-md-8 payment-form">
                    <div class="d-flex justify-content-between header">
                        <img src="" alt="TransLite Logo" />
                        <div class="text-end">
                            <span class="fw-bold text-primary d-block">₦126,875.00</span>
                            <span class="text-muted" style="font-size:12px">agilac267@examplebseb.com</span>
                        </div>
                    </div>

                    <p class="mt-3 ps-4 pe-4" style="font-size: 14px">Please enter your card details</p>

                    <form class="ps-4 pe-4">
                        <div class="mb-4">
                            <label for="cardNumber" class="form-label" style="font-size: 14px">Card Number</label>
                            <input type="text" id="cardNumber" class="form-control"
                                placeholder="0000 0000 0000 0000">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="expiry" class="form-label" style="font-size: 14px">Card Expiry</label>
                                <input type="text" id="expiry" class="form-control" placeholder="MM/YY">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label" style="font-size: 14px">CVV</label>
                                <input type="password" id="cvv" class="form-control" placeholder="***">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" disabled>Next</button>
                    </form>


                </div>

            </div>

        </div>

        <div class="version text-center text-muted" style="font-size: 12px; font-weight: 500">
            powered by <span class="text-danger">xtrapay
                technologies</span><br>Version: Demo
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cardNumber = document.getElementById("cardNumber");
            const expiry = document.getElementById("expiry");
            const cvv = document.getElementById("cvv");
            const nextButton = document.querySelector("button");

            function checkInputs() {
                if (cardNumber.value.length > 15 && expiry.value.length > 4 && cvv.value.length > 2) {
                    nextButton.removeAttribute("disabled");
                } else {
                    nextButton.setAttribute("disabled", "true");
                }
            }

            cardNumber.addEventListener("input", checkInputs);
            expiry.addEventListener("input", checkInputs);
            cvv.addEventListener("input", checkInputs);
        });
    </script>

</body>

</html>
