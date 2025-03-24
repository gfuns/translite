@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Dashboard')

<div class="content-w">
    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <h6 class="element-header">Dashboard</h6>
                        <div
                            class="custom-alert fade show custom-alert-warning d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <span class="os-icon os-icon-alert-circle custom-alert-text"
                                    style="font-weight:bold;"></span>
                                &nbsp;<span class="custom-alert-text">Activate your business to start receiving payments
                                    with TransLite!</span>
                            </div>

                            <div>
                                <a href="{{ route('business.kyc.apply') }}"> <button
                                        class="btn btn-default custom-alert-button"
                                        style="font-size: 12px">Activate</button></a>
                            </div>
                        </div>

                        <div class="element-content">
                            <h6>Welcome to TransLite, {{ Auth::user()->firstName }} 👋</h6>

                            <div class="row mt-3">
                                <div class="col-12 col-md-8">


                                    <div class="element-box" style="padding: 0px">
                                        <div class="eb">
                                            <h5>Let’s get you started! 🎉</h5>
                                            <p>Complete these steps to successfully collect your first payment through
                                                TransLite.<br />
                                                We would help you tick off each step. Reach out to us if you need any
                                                help.
                                            </p>
                                        </div>
                                        <hr />

                                        <div class="progress-container">

                                            <div class="progress-step">
                                                <div class="progress-icon completed">✔</div>
                                                <div class="step-element" style="display: flex; gap: 20px; ">
                                                    <div>
                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10 15H20" stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M15 20V10" stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path
                                                                d="M11.25 27.5H18.75C25 27.5 27.5 25 27.5 18.75V11.25C27.5 5 25 2.5 18.75 2.5H11.25C5 2.5 2.5 5 2.5 11.25V18.75C2.5 25 5 27.5 11.25 27.5Z"
                                                                stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="onbh">Sign Up on TransLite</span><br />
                                                        <span class="onbs">Create an account on TransLite to get
                                                            started.</span>
                                                    </div>
                                                </div>

                                                <div class="progress-line"></div>
                                            </div>

                                            <div class="progress-step">
                                                <div class="progress-icon current">⏳</div>
                                                <div class="step-element" style="display: flex; gap: 20px; ">
                                                    <div>
                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.4125 24.625C9.4375 23.525 11 23.6125 11.9 24.8125L13.1625 26.5C14.175 27.8375 15.8125 27.8375 16.825 26.5L18.0875 24.8125C18.9875 23.6125 20.55 23.525 21.575 24.625C23.8 27 25.6125 26.2125 25.6125 22.8875V8.8C25.625 3.7625 24.45 2.5 19.725 2.5H10.275C5.55 2.5 4.375 3.7625 4.375 8.8V22.875C4.375 26.2125 6.2 26.9875 8.4125 24.625Z"
                                                                stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M10.1181 13.75H10.1294" stroke="#0765FF"
                                                                stroke-width="2.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M13.625 13.75H20.5" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M10.1181 8.75H10.1294" stroke="#0765FF"
                                                                stroke-width="2.5" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M13.625 8.75H20.5" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="onbh">Activate Your Business</span><br />
                                                        <span class="onbs">Submit all required documents to start
                                                            collecting live payments.</span>
                                                    </div>
                                                </div>
                                                <div class="progress-line"></div>
                                            </div>

                                            <div class="progress-step">
                                                <div class="progress-icon pending">●</div>
                                                <div class="step-element" style="display: flex; gap: 20px; ">
                                                    <div>
                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M21.25 26.5625H8.75C4.1875 26.5625 1.5625 23.9375 1.5625 19.375V10.625C1.5625 6.0625 4.1875 3.4375 8.75 3.4375H21.25C25.8125 3.4375 28.4375 6.0625 28.4375 10.625V19.375C28.4375 23.9375 25.8125 26.5625 21.25 26.5625ZM8.75 5.3125C5.175 5.3125 3.4375 7.05 3.4375 10.625V19.375C3.4375 22.95 5.175 24.6875 8.75 24.6875H21.25C24.825 24.6875 26.5625 22.95 26.5625 19.375V10.625C26.5625 7.05 24.825 5.3125 21.25 5.3125H8.75Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M15 19.6875C12.4125 19.6875 10.3125 17.5875 10.3125 15C10.3125 12.4125 12.4125 10.3125 15 10.3125C17.5875 10.3125 19.6875 12.4125 19.6875 15C19.6875 17.5875 17.5875 19.6875 15 19.6875ZM15 12.1875C13.45 12.1875 12.1875 13.45 12.1875 15C12.1875 16.55 13.45 17.8125 15 17.8125C16.55 17.8125 17.8125 16.55 17.8125 15C17.8125 13.45 16.55 12.1875 15 12.1875Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M5.625 13.4375C5.1125 13.4375 4.6875 13.0125 4.6875 12.5V10.625C4.6875 8.3875 6.5125 6.5625 8.75 6.5625H10.625C11.1375 6.5625 11.5625 6.9875 11.5625 7.5C11.5625 8.0125 11.1375 8.4375 10.625 8.4375H8.75C7.55 8.4375 6.5625 9.425 6.5625 10.625V12.5C6.5625 13.0125 6.1375 13.4375 5.625 13.4375Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M24.375 13.4375C23.8625 13.4375 23.4375 13.0125 23.4375 12.5V10.625C23.4375 9.425 22.45 8.4375 21.25 8.4375H19.375C18.8625 8.4375 18.4375 8.0125 18.4375 7.5C18.4375 6.9875 18.8625 6.5625 19.375 6.5625H21.25C23.4875 6.5625 25.3125 8.3875 25.3125 10.625V12.5C25.3125 13.0125 24.8875 13.4375 24.375 13.4375Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M10.625 23.4375H8.75C6.5125 23.4375 4.6875 21.6125 4.6875 19.375V17.5C4.6875 16.9875 5.1125 16.5625 5.625 16.5625C6.1375 16.5625 6.5625 16.9875 6.5625 17.5V19.375C6.5625 20.575 7.55 21.5625 8.75 21.5625H10.625C11.1375 21.5625 11.5625 21.9875 11.5625 22.5C11.5625 23.0125 11.1375 23.4375 10.625 23.4375Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M21.25 23.4375H19.375C18.8625 23.4375 18.4375 23.0125 18.4375 22.5C18.4375 21.9875 18.8625 21.5625 19.375 21.5625H21.25C22.45 21.5625 23.4375 20.575 23.4375 19.375V17.5C23.4375 16.9875 23.8625 16.5625 24.375 16.5625C24.8875 16.5625 25.3125 16.9875 25.3125 17.5V19.375C25.3125 21.6125 23.4875 23.4375 21.25 23.4375Z"
                                                                fill="#0765FF"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="onbh">Business Review in Progress</span><br />
                                                        <span class="onbs">We're reviewing your documents. In the
                                                            meantime, explore and test our services.</span>
                                                    </div>
                                                </div>
                                                <div class="progress-line"></div>
                                            </div>

                                            <div class="progress-step">
                                                <div class="progress-icon pending">●</div>
                                                <div class="step-element" style="display: flex; gap: 20px; ">
                                                    <div>
                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.8344 20.272V16.7185H11V15.6539H11.8344V14.6181H11V13.5535H11.8344V10H14.0931L15.2152 13.5535H16.5244V10H18.1213V13.5535H18.9414V14.6181H18.1213V15.6539H18.9414V16.7185H18.1213V20.272H15.8483L14.6973 16.7185H13.4313V20.272H11.8344ZM13.4313 15.6539H14.3808L14.0643 14.6181H13.4025L13.4313 15.6539ZM16.5676 18.0277H16.6395L16.582 16.7185H16.1935L16.5676 18.0277ZM13.3738 13.5535H13.7766L13.3594 12.1724H13.3018L13.3738 13.5535ZM15.8914 15.6539H16.5532L16.5244 14.6181H15.5605L15.8914 15.6539Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M27.5 15C27.5 21.9 21.9 27.5 15 27.5C8.1 27.5 2.5 21.9 2.5 15C2.5 8.1 8.1 2.5 15 2.5"
                                                                stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M21.25 3.75V8.75H26.25" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M27.5 2.5L21.25 8.75" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="onbh">Collect Your First Payment</span><br />
                                                        <span class="onbs">Setup and receive your first payment from
                                                            TransLite.</span>
                                                    </div>
                                                </div>
                                                <div class="progress-line"></div>
                                            </div>

                                            <div class="progress-step">
                                                <div class="progress-icon pending">●</div>
                                                <div class="step-element" style="display: flex; gap: 20px; ">
                                                    <div>
                                                        <svg width="30" height="30" viewBox="0 0 30 30"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.8344 20.272V16.7185H11V15.6539H11.8344V14.6181H11V13.5535H11.8344V10H14.0931L15.2152 13.5535H16.5244V10H18.1213V13.5535H18.9414V14.6181H18.1213V15.6539H18.9414V16.7185H18.1213V20.272H15.8483L14.6973 16.7185H13.4313V20.272H11.8344ZM13.4313 15.6539H14.3808L14.0643 14.6181H13.4025L13.4313 15.6539ZM16.5676 18.0277H16.6395L16.582 16.7185H16.1935L16.5676 18.0277ZM13.3738 13.5535H13.7766L13.3594 12.1724H13.3018L13.3738 13.5535ZM15.8914 15.6539H16.5532L16.5244 14.6181H15.5605L15.8914 15.6539Z"
                                                                fill="#0765FF"></path>
                                                            <path
                                                                d="M27.5 15C27.5 21.9 21.9 27.5 15 27.5C8.1 27.5 2.5 21.9 2.5 15C2.5 8.1 8.1 2.5 15 2.5"
                                                                stroke="#0765FF" stroke-width="1.875"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M27.5 7.5V2.5H22.5" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                            <path d="M21.25 8.75L27.5 2.5" stroke="#0765FF"
                                                                stroke-width="1.875" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span class="onbh">Receive Your First Settlement</span><br />
                                                        <span class="onbs">You've received your first payout from
                                                            TransLite.🎉</span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="element-box" href="#" style="padding:20px">
                                        <img src="{{ asset('contact-img.png') }}" class="img-fluid" />
                                        <div class="mt-2"><strong>Need Help?</strong></div>
                                        <div class="mt-2">Contact our dedicated onboarding
                                            customer help desk.</div>
                                        <div class="mt-2">
                                            <a href="mailto:help@translite.com">Contact Support <i
                                                    class="os-icon os-icon-arrow-right6" style="font-size:14px;"></i>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
