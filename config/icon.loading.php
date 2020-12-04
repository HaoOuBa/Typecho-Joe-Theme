<?php if ($this->options->JIconLoading !== "off") : ?>
    <script>
        (() => {
            window.initIconLoading = {
                start: () => {
                    if ($(".j-loading").length > 0) return
                    <?php if ($this->options->JIconLoading == "type1") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" xml:space="preserve">
                                <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"></path>
                                <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0C22.32,8.481,24.301,9.057,26.013,10.047z">
                                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"></animateTransform>
                                </path>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type2") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"  xml:space="preserve">
                                <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
                                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </path>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type3") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" xml:space="preserve">
                                <path fill="#000" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
                                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </path>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type4") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 24" xml:space="preserve">
                                <rect x="0" y="0" width="4" height="7" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="scale" values="1,1; 1,3; 1,1" begin="0s" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                                <rect x="10" y="0" width="4" height="7" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="scale" values="1,1; 1,3; 1,1" begin="0.2s" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                                <rect x="20" y="0" width="4" height="7" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="scale" values="1,1; 1,3; 1,1" begin="0.4s" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type5") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                                <rect x="0" y="0" width="4" height="10" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                                <rect x="10" y="0" width="4" height="10" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0.2s" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                                <rect x="20" y="0" width="4" height="10" fill="#333">
                                    <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0" begin="0.4s" dur="0.6s" repeatCount="indefinite"></animateTransform>
                                </rect>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type6") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                                <rect x="0" y="13" width="4" height="5" fill="#333">
                                    <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="10" y="13" width="4" height="5" fill="#333">
                                    <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="20" y="13" width="4" height="5" fill="#333">
                                    <animate attributeName="height" attributeType="XML" values="5;21;5" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="13; 5; 13" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type7") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                                <rect x="0" y="0" width="4" height="20" fill="#333">
                                    <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="7" y="0" width="4" height="20" fill="#333">
                                    <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0.2s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="14" y="0" width="4" height="20" fill="#333">
                                    <animate attributeName="opacity" attributeType="XML" values="1; .2; 1" begin="0.4s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type8") : ?>
                        $("body").append(`
                            <svg version="1.1" class="j-loading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 24 30" xml:space="preserve">
                                <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="8" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                                <rect x="16" y="10" width="4" height="10" fill="#333" opacity="0.2">
                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                </rect>
                            </svg>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type9") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <svg version="1.1" id="dc-spinner" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38 38" preserveAspectRatio="xMinYMin meet">
                                    <text x="14" y="21" font-family="Monaco" font-size="2px" style="letter-spacing:0.6" fill="#ffffff">LOADING
                                        <animate attributeName="opacity" values="0;1;0" dur="1.8s" repeatCount="indefinite"></animate></text>
                                    <path fill="#373a42" d="M20,35c-8.271,0-15-6.729-15-15S11.729,5,20,5s15,6.729,15,15S28.271,35,20,35z M20,5.203
                                    C11.841,5.203,5.203,11.841,5.203,20c0,8.159,6.638,14.797,14.797,14.797S34.797,28.159,34.797,20
                                    C34.797,11.841,28.159,5.203,20,5.203z">
                                    </path>
                                    <path fill="#373a42" d="M20,33.125c-7.237,0-13.125-5.888-13.125-13.125S12.763,6.875,20,6.875S33.125,12.763,33.125,20
                                    S27.237,33.125,20,33.125z M20,7.078C12.875,7.078,7.078,12.875,7.078,20c0,7.125,5.797,12.922,12.922,12.922
                                    S32.922,27.125,32.922,20C32.922,12.875,27.125,7.078,20,7.078z">
                                    </path>
                                    <path fill="#2AA198" stroke="#2AA198" stroke-width="0.6027" stroke-miterlimit="10" d="M5.203,20
                                    c0-8.159,6.638-14.797,14.797-14.797V5C11.729,5,5,11.729,5,20s6.729,15,15,15v-0.203C11.841,34.797,5.203,28.159,5.203,20z">
                                        <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" calcMode="spline" keySplines="0.4, 0, 0.2, 1" keyTimes="0;1" dur="2s" repeatCount="indefinite"></animateTransform>
                                    </path>
                                    <path fill="#859900" stroke="#859900" stroke-width="0.2027" stroke-miterlimit="10" d="M7.078,20
                                    c0-7.125,5.797-12.922,12.922-12.922V6.875C12.763,6.875,6.875,12.763,6.875,20S12.763,33.125,20,33.125v-0.203
                                    C12.875,32.922,7.078,27.125,7.078,20z">
                                        <animateTransform attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1.8s" repeatCount="indefinite"></animateTransform>
                                    </path>
                                </svg>
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type10") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/audio.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type11") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/ball-triangle.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type12") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/bars.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type13") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/circles.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type14") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/grid.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type15") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/hearts.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type16") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/oval.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type17") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/puff.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type18") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/rings.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type19") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/spinning-circles.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type20") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/tail-spin.svg'); ?>">
                            </div>
                        `)
                    <?php elseif ($this->options->JIconLoading == "type21") : ?>
                        $("body").append(`
                            <div class="j-loading full">
                                <img src="<?php $this->options->themeUrl('assets/svg/three-dots.svg'); ?>">
                            </div>
                        `)
                    <?php endif; ?>
                    $(".j-loading").css("top", $(".j-header").height() + 10)
                },
                end: () => {
                    $(".j-loading").remove()
                }
            }

        })(window)
    </script>
<?php endif; ?>