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
<?php echo $__env->make("base", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/david/Plocha/učení/4IZ278/bluejet-web/resources/views/test.blade.php ENDPATH**/ ?>