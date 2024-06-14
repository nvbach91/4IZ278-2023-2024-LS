<?php $__env->startSection("content"); ?>
<div class="row" id="ticketbox-bg-row">
    <div class="col">
        <div class="container-fluid" id="ticketbox-bg">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-4" id="mottobox">
                    <h1>Leťte s BlueJet</h1>
                    <p>Vzletíme s vámi vždy vysoko a daleko.</p>
                </div>
                <div class="col-4">
                    <div class="container-fluid" id="ticketbox">
                        <form method="POST" action="/findtickets">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ticketType" id="ticketTypeOneWay">
                                        <label class="form-check-label" for="ticketTypeOneWay">Jednosměrná</label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="ticketType" id="ticketTypeTwoWay">
                                        <label class="form-check-label" for="ticketTypeTwoWay">Zpáteční</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label>Let z</label>
                                    <select class="form-select" aria-label="Select">
                                        <option selected>Praha</option> <!-- destinations will be loaded from DB -->
                                        <optgroup label="Argentina">
                                            <option>Buenos Aires</option>
                                        </optgroup>
                                        <optgroup label="Brazílie">
                                            <option>Rio de Janeiro</option>
                                        </optgroup>
                                        <optgroup label="Spojené státy">
                                            <option>Chicago</option>
                                            <option>New York</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Let do</label>
                                    <select class="form-select" aria-label="Select">
                                        <option selected>Praha</option>
                                        <optgroup label="Argentina">
                                            <option>Buenos Aires</option>
                                        </optgroup>
                                        <optgroup label="Brazílie">
                                            <option>Rio de Janeiro</option>
                                        </optgroup>
                                        <optgroup label="Spojené státy">
                                            <option>Chicago</option>
                                            <option>New York</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Datum odletu</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Datum návratu</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="container">
            <h1 class="mt-3">Placeholder</h1>
            <p>
                Information and section placeholder
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("modals"); ?>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("base", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/david/Plocha/učení/4IZ278/bluejet-web/resources/views/index.blade.php ENDPATH**/ ?>