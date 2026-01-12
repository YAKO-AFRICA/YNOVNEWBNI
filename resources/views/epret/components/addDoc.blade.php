<div class="modal fade" id="add-doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="mb-1">Documents de souscription</h5>

                <p class="mb-4">Veuillez chargez vos documents de souscription</p>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <form action="{{ route('prod.storeDocPret') }}" method="POST" enctype="multipart/form-data" class="submitForm">
                    @csrf

                    <input type="hidden" name="pret" value="{{ $pret->id }}">
                    <div class="row g-3">
                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">Bulletin d' adhesion</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" multiple onchange="previewFiles(event, 'previewBulletin')">

                                            <input type="hidden" name="libelles[]" value="Bulletin d' adhesion">

                                            

                                        </div>

                                        <div id="previewBulletin" class="mt-3 preview-area"></div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Pièce justificatif d'identité (CNI) -->

                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">Pièce justificatif d'identité (CNI)</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="previewFiles(event, 'previewCNI')">

                                            <input type="hidden" name="libelles[]" value="Pièce justificatif d'identité (CNI)">

                                            

                                        </div>

                                        <div id="previewCNI" class="mt-3 preview-area"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">RIB</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="previewFiles(event, 'previewRIB')">

                                            <input type="hidden" name="libelles[]" value="RIB">

                                            

                                        </div>

                                        <div id="previewRIB" class="mt-3 preview-area"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Signature -->

                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">Signature</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="previewFiles(event, 'previewSignature')">

                                            <input type="hidden" name="libelles[]" value="Signature">

                                            

                                        </div>

                                        <div id="previewSignature" class="mt-3 preview-area"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Photo -->

                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">Photo</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="previewFiles(event, 'previewPhoto')">

                                            <input type="hidden" name="libelles[]" value="Photo">

                                        </div>

                                        <div id="previewPhoto" class="mt-3 preview-area"></div>

                                    </div>

                                </div>

                            </div>

                        </div>

                

                        <!-- Autres pièces -->

                        <div class="col-xl-9 mx-auto">

                            <div class="card">

                                <div class="card-body">

                                    <div class="mb-3">

                                        <label class="form-label">Autres pièces</label>

                                        <div class="input-group">

                                            <input type="file" name="files[]" class="form-control" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="previewFiles(event, 'previewAutres')">

                                            <input type="hidden" name="libelles[]" value="Autres pièces">

                                            

                                        </div>

                                        <div id="previewAutres" class="mt-3 preview-area"></div>

                                    </div>

                                </div>

                            </div>

                        </div>
                </div>

                <div class="modal-footer">

                    <button type="submit" class="btn btn-success px-4">Submit</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

                

            </form>

            

        </div>

    </div>

</div>