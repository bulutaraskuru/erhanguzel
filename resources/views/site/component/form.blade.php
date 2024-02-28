<section id="form" style="padding-top:00px; padding-bottom:0px;">
    <div class="container-fluid w-100 blockquote blockquote-color" style="margin-bottom: 0px;">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-6">
                <h4 class="text-uppercase text-center text-white" style="font-size: 32px;">YÖNETEN KENT ÇATALCA</h4>
                <div class="m-t-30">
                    <div id="msgSubmit" class="h3 hidden"></div>
                    <div id="alertDiv" class="alert" role="alert" style="display: none;"></div>
                    <form id="form1" method="POST" action="{{ route('site.contact.voluntarily') }}"
                          class="form-validate" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="text-white">Ad ve Soyad</label>
                                <input type="text" aria-required="true" name="name" id="name"
                                       class="form-control name" placeholder="Ad ve Soyad yazınız">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="text-white">Telefon No</label>
                                <input type="tel" aria-required="true" name="phone" id="phone"
                                       class="form-control phone" placeholder="Telefon No yazını">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="text-white">E-mail</label>
                                <input type="email" aria-required="true" name="email" id="email"
                                       class="form-control email" placeholder="Email yazınız">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="neighbourhood" class="text-white">Mahalle</label>
                                <select class="form-select" id="neighbourhood" name="neighbourhood">
                                    <option disabled selected>Seçiniz</option>
                                    @foreach (\App\Helpers\bHelper::neighbourhood() as $key => $item)
                                        <option @selected(old('neighbourhood') == $item) value="{{ $item }}">
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="year" class="text-white">Doğum Yılı</label>
                                <select class="form-select" id="year" name="year">
                                    <option disabled selected>Seçiniz</option>
                                    @for ($i = 1940; $i <= 2023; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="year" class="text-white">Mesajınız</label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-content-center">
                            <button class="btn btn-light btn-rounded mt-5" style="width: 225px;" type="submit"><i
                                    class="fa fa-paper-plane"></i>Gönder
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
