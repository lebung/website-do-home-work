<div class="modal fade" id="exampleModalcreate" tabindex="-1" aria-labelledby="exampleModalSizeLg" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo câu hỏi câu trả lời</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="" style="min-height: 500px;">

                    @include('screens.backend.questionquiz.components.layout.option')

                    <form class="form" enctype="multipart/form-data" id="formcreate" method="post" preventDefault>
                        @csrf
                        <div class='form-group mt-5'>
                            <div id="form-errors-create">
                            </div>
                            <label>Câu hỏi</label>
                            <textarea rows='2' placeholder='Nhập câu hỏi...' class='form-control' name='title'></textarea>
                            @error('title')
                                <span>{{ $messenger }}</span>
                            @enderror

                            <div class="card card-custom gutter-b">
                                <div class="card-header card-header-tabs-line">
                                    <div class="card-title">
                                        <h3 class="card-label">Chọn kiểu câu hỏi</h3>
                                    </div>
                                    <div class="card-toolbar" id="card-toolbar">
                                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_0_2"
                                                    onclick="clicktab(0)">Ảnh</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_1_2"
                                                    onclick="clicktab(1)">MP3</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="tab-content" id="tab-content">
                                        <div class="tab-pane fade show active" id="kt_tab_pane_0_2" role="tabpanel"
                                            aria-labelledby="kt_tab_pane_2">
                                            <div class="form-group">
                                                <label>Ảnh slide</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file-image"
                                                        name="attachment" accept=".png, .jpg, .jpeg, .jfif, .webp"
                                                        id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                                <div class="preview-image new"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Example-->
                        <div class="tab-content mt-5" id="my-options">
                            {{-- ----------- this component call api render html -------------- --}}
                        </div>
                        <!--end::Example-->
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
