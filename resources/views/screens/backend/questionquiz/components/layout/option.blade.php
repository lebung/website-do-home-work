<!--begin::Quick Actions-->
<div class="dropdown">
    <!--begin::Toggle-->
    <div class="topbar-item" data-toggle="dropdown" onclick="show_menu(0)">
        <i class="flaticon-squares-1 text-success"></i>
        <strong class="btn" id="">Chọn loại câu hỏi</strong>
    </div>
    <!--end::Toggle-->
    <!--begin::Dropdown-->
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg" id="dropdown-option">
        <!--begin:Header-->
        <div class="d-flex flex-column flex-center py-10 bgi-size-cover bgi-no-repeat rounded-top"
            style="background-image: url(assets/media/misc/bg-1.jpg)">
            <h4 class="text-white font-weight-bold">Quick Actions</h4>
            <span class="btn btn-success btn-sm font-weight-bold font-size-sm mt-2 p-3"
                onclick="optiondropdown.classList.remove('show')">Trở lại</span>
        </div>
        <!--end:Header-->
        <!--begin:Nav-->
        <div class="row row-paddingless" id="option_quesions">
            <!--begin:Item-->
            <div class="col-6" onclick="show_form_create(0)">
                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right border-bottom">
                        <i class="flaticon-questions-circular-button display-4 text-success"></i>
                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Trắc nghiệm đúng
                        sai</span>
                    <span class="d-block text-dark-50 font-size-lg">eCommerce</span>
                </a>
            </div>
            <!--end:Item-->
            <!--begin:Item-->
            <div class="col-6" onclick="show_form_create(1)">
                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-bottom">
                    <i class="flaticon-questions-circular-button display-4 text-success"></i>
                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Trắc nghiệm 1 lựa
                        chọn</span>
                    <span class="d-block text-dark-50 font-size-lg">Console</span>
                </a>
            </div>
            <!--end:Item-->
            <!--begin:Item-->
            <div class="col-6" onclick="show_form_create(2)">
                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light border-right">
                    <i class="flaticon-questions-circular-button display-4 text-success"></i>
                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Trắc nghiệm nhiều
                        lựa chọn</span>
                    <span class="d-block text-dark-50 font-size-lg">Pending Tasks</span>
                </a>
            </div>
            <!--end:Item-->
            <!--begin:Item-->
            <div class="col-6 bg-hover-light" onclick="show_form_create(3)">
                <a href="#" class="d-block py-10 px-5 text-center">
                    <i class="flaticon-questions-circular-button display-4 text-success"></i>
                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Câu hỏi tự
                        luận</span>
                    <span class="d-block text-dark-50 font-size-lg">Latest cases</span>
                </a>
            </div>
            <!--end:Item-->
            <!--begin:Item-->
            <div class="col-12 border-top" onclick="show_form_create(4)">
                <a href="#" class="d-block py-10 px-5 text-center bg-hover-light ">
                    <i class="flaticon-questions-circular-button display-4 text-success"></i>
                    <span class="d-block text-dark-75 font-weight-bold font-size-h6 mt-2 mb-1">Câu hỏi ghép đáp
                        án</span>
                    <span class="d-block text-dark-50 font-size-lg">Latest cases</span>
                </a>
            </div>
            <!--end:Item-->
        </div>
        <!--end:Nav-->
    </div>
    <!--end::Dropdown-->
</div>
<!--end::Quick Actions-->
