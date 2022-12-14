@if($contentDetail['data'][0]->Author)
    <div class="dotted-space">...</div>
<div class="container content-detail-660 pt-2">
    <div class="row pt-2">
        <div class="col-sm-2 text-center">
            @if(isset($contentDetail['data'][0]->Author->new_image))
                <img class="image-preview" src="data:image/png;base64,{{ $contentDetail['data'][0]->Author->new_image }}" id="preview">
            @endif
        </div>
        <div class="col-sm-10 written-by">
            <span class="text-gray">Written by</span>
            <h5>{{ isset($contentDetail['data'][0]->Author->name) ? $contentDetail['data'][0]->Author->name : '' }}</h5>
        </div>
    </div>
    <div class="row text-gray">
        <div class="col">
            <p>
                {!! isset($contentDetail['data'][0]->Author->longtext) ? $contentDetail['data'][0]->Author->longtext : '' !!}
            </p>
        </div>

    </div>
</div>
@endif

@if($contentDetail['data'][0]->Sitename)
    <div class="dotted-space pb-3">...</div>

<div class="container content-detail-660 pt-2">
    <div class="col-sm-2 text-center d-block d-sm-none pb-3">
        @if(isset($contentDetail['data'][0]->Sitename->new_image))
            <img class="image-preview" src="data:image/png;base64,{{ $contentDetail['data'][0]->Sitename->new_image }}" id="preview">
        @endif
    </div>
    <h4>{{ isset( $contentDetail['data'][0]->Sitename->title ) ?  $contentDetail['data'][0]->Sitename->title : '' }}</h4>
    <div class="row text-gray">
        <div class="col-10">
            <p>
                {!! isset( $contentDetail['data'][0]->Sitename->longtext ) ? $contentDetail['data'][0]->Sitename->longtext : '' !!}
            </p>
        </div>
        <div class="col-2">
            @if(isset($contentDetail['data'][0]->Sitename->new_image))
                <img class="image-preview d-none d-sm-block" src="data:image/png;base64,{{ $contentDetail['data'][0]->Sitename->new_image }}" id="preview">
            @endif
        </div>
    </div>
</div>
@endif
<div class="dotted-space " style="margin-bottom:30px;">...</div>

<div class="container content-detail-660 pt-2 green-bg">
    <div class="row p-2">
        <div class="col-sm-2 text-center">
            @if(isset($contentDetail['data'][0]->Sitename->new_vip_image))
                <img class="image-preview" src="data:image/png;base64,{{ $contentDetail['data'][0]->Sitename->new_vip_image }}" id="preview">
            @endif
        </div>
        <div class="col-sm-10 written-by">
            <p class="m-0">{{ isset( $contentDetail['data'][0]->Sitename->vip_title1 ) ? $contentDetail['data'][0]->Sitename->vip_title1 : '' }}</p>
            <h6>{{ isset( $contentDetail['data'][0]->Sitename->vip_title2 ) ? $contentDetail['data'][0]->Sitename->vip_title2 : ''}}</h6>
            <h6>{{ isset( $contentDetail['data'][0]->Sitename->vip_title3 ) ? $contentDetail['data'][0]->Sitename->vip_title3 : '' }}</h6>
        </div>
    </div>
    <div class="row p-2">
        <div class="col">
            {!! isset( $contentDetail['data'][0]->Sitename->vip_longtext ) ?$contentDetail['data'][0]->Sitename->vip_longtext : '' !!}
        </div>
    </div>
    <div class="p-2">
        <div id="60dc214b37393330cb3e6286" style="width: 100%; height: 100%;">
            <div id="60dc214b37393330cb3e6286-form" class="60dc214b37393330cb3e6286-template" style="position: relative; display: flex; height: 100%; align-items: center; justify-content: center;">
                <div id="selected-_ylmkoptih" class=" ap3w-embeddable-form ap3w-embeddable-form--full ap3w-embeddable-form--solid " data-select="true">
                    <form id="ap3w-embeddable-form-60dc214b37393330cb3e6286" class="ap3w-embeddable-form-content">
                        <div class="row">
                            <div id="selected-_pi9t9h1oz" class="col-sm-6 ap3w-form-input ap3w-form-input-60dc214b37393330cb3e6286" data-select="true" data-field-id="str::first" data-merge-strategy="override">
                                <label for="ap3w-form-input-text-60dc214b37393330cb3e6286" class="ap3w-form-input-label">Name*</label>
                                <input type="text" class="form-control vip" id="ap3w-form-input-text-60dc214b37393330cb3e6286" step="1" name="first_name" required="">
                            </div>
                            <div id="selected-_had07cs3o" class="col-sm-6 ap3w-form-input ap3w-form-input-60dc214b37393330cb3e6286" data-select="true" data-field-id="str::email" data-merge-strategy="override">
                                <label for="ap3w-form-input-email-60dc214b37393330cb3e6286" class="ap3w-form-input-label">Email*</label>
                                <input type="email" class="form-control vip" id="ap3w-form-input-email-60dc214b37393330cb3e6286" step="1" name="email" required="">
                            </div>
                        </div>
                        <div id="selected-_2gtm66mhj" class="pt-3 ap3w-form-button ap3w-form-button-60dc214b37393330cb3e6286 ">
                            <button class="button-green float-right" id="ap3w-form-button-60dc214b37393330cb3e6286" type="submit" data-select="true" data-button-on-click="thank-you">
                                GET IT NOW!
                            </button>
                        </div>
                    </form>
                    <div class="ap3w-powered-by-autopilot--container ap3w-powered-by-autopilot--container--bottom">
                        <div style="display:flex;justify-content:center">
                            <a href="https://autopilotapp.com?utm_source=autopilotapp&amp;utm_medium=widget&amp;utm_campaign=poweredbyautopilot" target="_blank" rel="noopener noreferrer" class="box__Box-sc-1twe5h5-0 hmsUTZ">
                                <svg viewBox="0 0 164 13" width="124px" height="1.3rem" xmlns="http://www.w3.org/2000/svg" class="powered-by-autopilot-logo__SvgWrapper-cee45l-0 dVyoK ap3w-powered-by-autopilot" fill="rgba(81, 83, 86, 0.5)">
                                    <path d="M62.192 3.394L64.098 8.6h.027l1.746-5.207h1.493l-2.72 7.231c-.386 1.052-.826 1.891-2.132 1.891-.4 0-.733-.066-1-.133v-1.065h.12c.587.08 1.027.04 1.333-.333.254-.306.44-.84.187-1.478l-2.466-6.113h1.506zM112.856.117c1.752.004 3.163.566 4.232 1.687 1.073 1.125 1.609 2.56 1.609 4.307 0 1.746-.536 3.181-1.609 4.306-1.054 1.095-2.439 1.651-4.156 1.67l-.076.001h-4.509c-1.728 0-3.12-.54-4.175-1.62l-.056-.059c-1.062-1.12-1.593-2.552-1.593-4.298s.53-3.182 1.593-4.307C105.178.68 106.588.117 108.347.117h4.51zM83.888.3c.862 0 1.57.662 1.641 1.504l.007.142v5.691c0 .55.153.975.46 1.277.308.302.763.452 1.367.452.56 0 .99-.164 1.286-.493.26-.287.405-.655.438-1.103l.007-.197V1.796c0-.778.594-1.417 1.353-1.49L90.591.3h.386c.778 0 1.418.594 1.49 1.353l.007.144v5.646c0 1.455-.436 2.589-1.31 3.402-.873.813-2.156 1.22-3.85 1.22-1.703 0-2.989-.401-3.857-1.204-.81-.749-1.242-1.791-1.296-3.127l-.006-.29V1.944c0-.861.662-1.568 1.505-1.64L83.802.3h.086zm-7.572.024c.975 0 1.853.57 2.252 1.446l.07.168 3.063 8.259a1.247 1.247 0 01-1.043 1.676l-.128.006h-.716a1.498 1.498 0 01-1.372-.895l-.049-.128-.225-.674h-3.914l-.225.674c-.189.567-.696.963-1.283 1.017l-.137.006h-.603a1.173 1.173 0 01-1.137-1.455l.038-.122 3.09-8.363a2.472 2.472 0 012.32-1.615zM101.03.3a1.422 1.422 0 01.137 2.837l-.137.007h-1.893v6.99a1.69 1.69 0 01-3.374.145l-.007-.146v-6.99h-1.245a1.422 1.422 0 01-.137-2.836l.137-.007h6.519zM148.233 0c1.759 0 3.175.555 4.247 1.666 1.073 1.11 1.61 2.528 1.61 4.253 0 1.724-.537 3.141-1.61 4.252-1.072 1.1-2.488 1.65-4.247 1.65-1.76 0-3.17-.553-4.232-1.658-1.062-1.105-1.593-2.52-1.593-4.244 0-1.725.53-3.142 1.593-4.253C145.063.556 146.473 0 148.233 0zm-22.867.21c1.402 0 2.502.356 3.3 1.067.862.765 1.294 1.783 1.294 3.054 0 1.12-.375 2.052-1.124 2.796-.692.686-1.556 1.056-2.593 1.108l-.262.007h-2.556v1.834a1.69 1.69 0 01-3.374.146l-.006-.146v-8.52c0-.7.534-1.274 1.218-1.34l.13-.006h3.973zm7.141 0c.885 0 1.61.679 1.684 1.543l.006.146v8.177a1.69 1.69 0 01-3.374.146l-.006-.146V1.9a1.69 1.69 0 011.69-1.689zm4.772 0c.884 0 1.61.679 1.684 1.543l.006.146v6.973h2.154a1.447 1.447 0 01.14 2.886l-.14.007h-4.187c-.7 0-1.276-.534-1.341-1.217l-.007-.13v-8.52a1.69 1.69 0 011.69-1.688zm25.281 0a1.439 1.439 0 01.14 2.87l-.14.007h-1.876v6.99a1.69 1.69 0 01-3.374.145l-.006-.146v-6.99h-1.828a1.439 1.439 0 01-.138-2.87l.138-.006h7.084zM10.943 3.207c2.133 0 3.425 1.479 3.425 3.596 0 2.118-1.292 3.596-3.425 3.596S7.517 8.92 7.517 6.803c0-2.117 1.293-3.596 3.426-3.596zM55.408.677V4.22h.027c.36-.52 1.026-1.013 2.079-1.013 1.746 0 3.039 1.359 3.039 3.596S59.26 10.4 57.513 10.4c-1.052 0-1.719-.52-2.078-.986h-.027v.786h-1.4V.677h1.4zm-27.43 2.53c2.198 0 3.278 1.532 3.278 3.956h-5.225c0 1.145.733 2.09 1.973 2.09 1.16 0 1.626-.719 1.746-1.131h1.4c-.347 1.291-1.36 2.277-3.106 2.277-2.12 0-3.412-1.465-3.412-3.596 0-2.21 1.293-3.596 3.345-3.596zM50.142.677V10.2h-1.4v-.786h-.026c-.36.467-1.026.986-2.08.986-1.746 0-3.038-1.358-3.038-3.596 0-2.237 1.292-3.596 3.039-3.596 1.053 0 1.719.493 2.079 1.013h.026V.677h1.4zM39.72 3.207c2.2 0 3.279 1.532 3.279 3.956h-5.225c0 1.145.733 2.09 1.973 2.09 1.16 0 1.626-.719 1.746-1.131h1.4c-.347 1.291-1.36 2.277-3.106 2.277-2.12 0-3.413-1.465-3.413-3.596 0-2.21 1.293-3.596 3.346-3.596zm-4.265.027c.24 0 .413.013.613.04v1.318h-.027c-1.346-.226-2.426.68-2.426 2.131V10.2h-1.4V3.394h1.4v1.278h.027c.36-.852.92-1.438 1.813-1.438zm-19.447.16l1.386 5.167h.027l1.386-5.167h1.373l1.4 5.167h.026l1.373-5.167h1.48l-2.08 6.805h-1.413L19.5 5.005h-.027L18.021 10.2h-1.4l-2.093-6.805h1.48zM4.052.677c1.826 0 3.146.852 3.146 2.85 0 1.998-1.32 2.863-3.146 2.863H1.586v3.81H0V.676zm6.891 3.676c-1.333 0-2.026 1.038-2.026 2.45 0 1.398.693 2.45 2.026 2.45 1.333 0 2.026-1.052 2.026-2.45 0-1.412-.693-2.45-2.026-2.45zm35.934 0c-1.226 0-1.879 1.118-1.879 2.45s.653 2.45 1.88 2.45c1.146 0 1.852-.945 1.852-2.45 0-1.518-.706-2.45-1.853-2.45zm10.397 0c-1.146 0-1.853.932-1.853 2.45 0 1.505.707 2.45 1.853 2.45 1.226 0 1.88-1.118 1.88-2.45s-.654-2.45-1.88-2.45zm51.24-.944a2.695 2.695 0 102.695 2.694 2.695 2.695 0 00-2.696-2.694zm39.734-.2a2.695 2.695 0 102.696 2.693 2.695 2.695 0 00-2.696-2.694zm-72.004.896h-.033c-.138.526-.265.965-.38 1.318l-.056.169-.76 2.262h2.393l-.728-2.262-.436-1.487zm-48.267.208c-1.133 0-1.946.759-1.946 1.811h3.826c0-1.052-.747-1.811-1.88-1.811zm11.743 0c-1.133 0-1.946.759-1.946 1.811h3.825c0-1.052-.746-1.811-1.88-1.811zm85.5-1.307h-1.795v2.618h1.828c.41 0 .736-.124.979-.372.242-.248.363-.57.363-.97 0-.387-.12-.697-.363-.929-.243-.231-.58-.347-1.011-.347zM3.986 2.022H1.586v3.01h2.4c1.066 0 1.625-.453 1.625-1.505 0-1.039-.56-1.505-1.626-1.505z" fill-rule="nonzero"></path>
                                </svg>
                            </a></div>
                    </div>
                </div>
            </div>
            <div id="60dc214b37393330cb3e6286-thank-you" class="60dc214b37393330cb3e6286-template" style="position: relative; display: none; height: 100%; align-items: center; justify-content: center;">
                <div id="selected-_hxbrjimix" class=" ap3w-embeddable-form ap3w-embeddable-form--full ap3w-embeddable-form--solid " data-select="true">
                    <form id="ap3w-embeddable-form-60dc214b37393330cb3e6286" class="ap3w-embeddable-form-content">
                        <div id="selected-_suhti34pz" class="ap3w-text ap3w-text-60dc214b37393330cb3e6286 ap3w-text--first ap3w-text--last">
                            <div data-select="true"><h2>Thank you!</h2></div>
                        </div>
                    </form>
                    <div class="ap3w-powered-by-autopilot--container ap3w-powered-by-autopilot--container--bottom">
                        <div style="display:flex;justify-content:center">
                            <a href="https://autopilotapp.com?utm_source=autopilotapp&amp;utm_medium=widget&amp;utm_campaign=poweredbyautopilot" target="_blank" rel="noopener noreferrer" class="box__Box-sc-1twe5h5-0 hmsUTZ">
                                <svg viewBox="0 0 164 13" width="124px" height="1.3rem" xmlns="http://www.w3.org/2000/svg" class="powered-by-autopilot-logo__SvgWrapper-cee45l-0 dVyoK ap3w-powered-by-autopilot" fill="rgba(81, 83, 86, 0.5)">
                                    <path d="M62.192 3.394L64.098 8.6h.027l1.746-5.207h1.493l-2.72 7.231c-.386 1.052-.826 1.891-2.132 1.891-.4 0-.733-.066-1-.133v-1.065h.12c.587.08 1.027.04 1.333-.333.254-.306.44-.84.187-1.478l-2.466-6.113h1.506zM112.856.117c1.752.004 3.163.566 4.232 1.687 1.073 1.125 1.609 2.56 1.609 4.307 0 1.746-.536 3.181-1.609 4.306-1.054 1.095-2.439 1.651-4.156 1.67l-.076.001h-4.509c-1.728 0-3.12-.54-4.175-1.62l-.056-.059c-1.062-1.12-1.593-2.552-1.593-4.298s.53-3.182 1.593-4.307C105.178.68 106.588.117 108.347.117h4.51zM83.888.3c.862 0 1.57.662 1.641 1.504l.007.142v5.691c0 .55.153.975.46 1.277.308.302.763.452 1.367.452.56 0 .99-.164 1.286-.493.26-.287.405-.655.438-1.103l.007-.197V1.796c0-.778.594-1.417 1.353-1.49L90.591.3h.386c.778 0 1.418.594 1.49 1.353l.007.144v5.646c0 1.455-.436 2.589-1.31 3.402-.873.813-2.156 1.22-3.85 1.22-1.703 0-2.989-.401-3.857-1.204-.81-.749-1.242-1.791-1.296-3.127l-.006-.29V1.944c0-.861.662-1.568 1.505-1.64L83.802.3h.086zm-7.572.024c.975 0 1.853.57 2.252 1.446l.07.168 3.063 8.259a1.247 1.247 0 01-1.043 1.676l-.128.006h-.716a1.498 1.498 0 01-1.372-.895l-.049-.128-.225-.674h-3.914l-.225.674c-.189.567-.696.963-1.283 1.017l-.137.006h-.603a1.173 1.173 0 01-1.137-1.455l.038-.122 3.09-8.363a2.472 2.472 0 012.32-1.615zM101.03.3a1.422 1.422 0 01.137 2.837l-.137.007h-1.893v6.99a1.69 1.69 0 01-3.374.145l-.007-.146v-6.99h-1.245a1.422 1.422 0 01-.137-2.836l.137-.007h6.519zM148.233 0c1.759 0 3.175.555 4.247 1.666 1.073 1.11 1.61 2.528 1.61 4.253 0 1.724-.537 3.141-1.61 4.252-1.072 1.1-2.488 1.65-4.247 1.65-1.76 0-3.17-.553-4.232-1.658-1.062-1.105-1.593-2.52-1.593-4.244 0-1.725.53-3.142 1.593-4.253C145.063.556 146.473 0 148.233 0zm-22.867.21c1.402 0 2.502.356 3.3 1.067.862.765 1.294 1.783 1.294 3.054 0 1.12-.375 2.052-1.124 2.796-.692.686-1.556 1.056-2.593 1.108l-.262.007h-2.556v1.834a1.69 1.69 0 01-3.374.146l-.006-.146v-8.52c0-.7.534-1.274 1.218-1.34l.13-.006h3.973zm7.141 0c.885 0 1.61.679 1.684 1.543l.006.146v8.177a1.69 1.69 0 01-3.374.146l-.006-.146V1.9a1.69 1.69 0 011.69-1.689zm4.772 0c.884 0 1.61.679 1.684 1.543l.006.146v6.973h2.154a1.447 1.447 0 01.14 2.886l-.14.007h-4.187c-.7 0-1.276-.534-1.341-1.217l-.007-.13v-8.52a1.69 1.69 0 011.69-1.688zm25.281 0a1.439 1.439 0 01.14 2.87l-.14.007h-1.876v6.99a1.69 1.69 0 01-3.374.145l-.006-.146v-6.99h-1.828a1.439 1.439 0 01-.138-2.87l.138-.006h7.084zM10.943 3.207c2.133 0 3.425 1.479 3.425 3.596 0 2.118-1.292 3.596-3.425 3.596S7.517 8.92 7.517 6.803c0-2.117 1.293-3.596 3.426-3.596zM55.408.677V4.22h.027c.36-.52 1.026-1.013 2.079-1.013 1.746 0 3.039 1.359 3.039 3.596S59.26 10.4 57.513 10.4c-1.052 0-1.719-.52-2.078-.986h-.027v.786h-1.4V.677h1.4zm-27.43 2.53c2.198 0 3.278 1.532 3.278 3.956h-5.225c0 1.145.733 2.09 1.973 2.09 1.16 0 1.626-.719 1.746-1.131h1.4c-.347 1.291-1.36 2.277-3.106 2.277-2.12 0-3.412-1.465-3.412-3.596 0-2.21 1.293-3.596 3.345-3.596zM50.142.677V10.2h-1.4v-.786h-.026c-.36.467-1.026.986-2.08.986-1.746 0-3.038-1.358-3.038-3.596 0-2.237 1.292-3.596 3.039-3.596 1.053 0 1.719.493 2.079 1.013h.026V.677h1.4zM39.72 3.207c2.2 0 3.279 1.532 3.279 3.956h-5.225c0 1.145.733 2.09 1.973 2.09 1.16 0 1.626-.719 1.746-1.131h1.4c-.347 1.291-1.36 2.277-3.106 2.277-2.12 0-3.413-1.465-3.413-3.596 0-2.21 1.293-3.596 3.346-3.596zm-4.265.027c.24 0 .413.013.613.04v1.318h-.027c-1.346-.226-2.426.68-2.426 2.131V10.2h-1.4V3.394h1.4v1.278h.027c.36-.852.92-1.438 1.813-1.438zm-19.447.16l1.386 5.167h.027l1.386-5.167h1.373l1.4 5.167h.026l1.373-5.167h1.48l-2.08 6.805h-1.413L19.5 5.005h-.027L18.021 10.2h-1.4l-2.093-6.805h1.48zM4.052.677c1.826 0 3.146.852 3.146 2.85 0 1.998-1.32 2.863-3.146 2.863H1.586v3.81H0V.676zm6.891 3.676c-1.333 0-2.026 1.038-2.026 2.45 0 1.398.693 2.45 2.026 2.45 1.333 0 2.026-1.052 2.026-2.45 0-1.412-.693-2.45-2.026-2.45zm35.934 0c-1.226 0-1.879 1.118-1.879 2.45s.653 2.45 1.88 2.45c1.146 0 1.852-.945 1.852-2.45 0-1.518-.706-2.45-1.853-2.45zm10.397 0c-1.146 0-1.853.932-1.853 2.45 0 1.505.707 2.45 1.853 2.45 1.226 0 1.88-1.118 1.88-2.45s-.654-2.45-1.88-2.45zm51.24-.944a2.695 2.695 0 102.695 2.694 2.695 2.695 0 00-2.696-2.694zm39.734-.2a2.695 2.695 0 102.696 2.693 2.695 2.695 0 00-2.696-2.694zm-72.004.896h-.033c-.138.526-.265.965-.38 1.318l-.056.169-.76 2.262h2.393l-.728-2.262-.436-1.487zm-48.267.208c-1.133 0-1.946.759-1.946 1.811h3.826c0-1.052-.747-1.811-1.88-1.811zm11.743 0c-1.133 0-1.946.759-1.946 1.811h3.825c0-1.052-.746-1.811-1.88-1.811zm85.5-1.307h-1.795v2.618h1.828c.41 0 .736-.124.979-.372.242-.248.363-.57.363-.97 0-.387-.12-.697-.363-.929-.243-.231-.58-.347-1.011-.347zM3.986 2.022H1.586v3.01h2.4c1.066 0 1.625-.453 1.625-1.505 0-1.039-.56-1.505-1.626-1.505z" fill-rule="nonzero"></path>
                                </svg>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>