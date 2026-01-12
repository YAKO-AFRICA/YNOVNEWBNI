<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="qrCodeModalLabel">
    <div class="modal-dialog">
    <style>
            /* Cacher le QRCode sur les petits écrans (mobile) */
            #signature-qrcode {
                display: none;
            }

            /* Afficher le QRCode à partir des écrans ≥ 768px */
            @media (min-width: 768px) {
                #signature-qrcode {
                    display: block;
                }

                #signature-iframe {
                    display: none;
                }
            }
        </style>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Signature electroique</h5>
            </div>

            <div class="modal-body">

                <div class="card p-2" id="signature-iframe">
                    
                    <iframe
                        src="{{ url(config('services.sign_api') . 'signature/' . $token['token'] . '/' . $token['operation_type'] . '/' . $token['key_uuid']) }}"
                        frameborder="0" style="width: 100%; height: 60vh"></iframe>
                </div>
                <div class="card p-2" id="signature-qrcode">
                    <div class="card-header text-center">
                        <h4>Veuillez scanner ce code QR pour éffectuer votre signature</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center justify-content-center">
                                {!! QrCode::size(200)->generate(
                                    config('services.sign_api') .
                                        'signature/' .
                                        $token['token'] .
                                        '/' .
                                        $token['operation_type'] .
                                        '/' .
                                        $token['key_uuid'],
                                ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                Vous pouvez également signer en cliquant:
                                <a target="_blank"
                                    href="{{ config('services.sign_api') . 'signature/' . $token['token'] . '/' . $token['operation_type'] . '/' . $token['key_uuid'] }}">
                                    <strong>ICI</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>