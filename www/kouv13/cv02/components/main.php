<main class="row justify-content-around">
        <?php
        foreach ($persons as $person) :
        ?>
        <section class="row col-12 justify-content-around cards">
            <div class="col-5 row  my-card" id="front">
                <div class="col-9">
                    <h2 class="name"><?php echo $person->getFullName(); ?></h2>
                    <p><?php echo $person->title . ' | ' . $person->getJobMessage(); ?></p>
                </div>
                <div class="col-3 text-end">
                    <img src="<?php echo $person->logo;  ?>" alt="logo" class="w-75">
                </div>
                <div class="col-12 personal-info align-self-end">
                    <p>
                    <?php echo $person->getAge(); ?> let
                    </p>
                    <p>
                    <?php echo $person->email; ?>
                    </p>
                    <p>
                    <?php echo $person->phone; ?>
                    </p>
                </div>
            </div>
            <div class="col-5 my-card row" id="back">
                <div class="col-12 company-info align-self-center">
                    <h3>
                    <?php echo strtoupper($person->companyName);  ?>
                    </h3>
                    <p class="mb-5">
                    <?php echo $person->getAddress();  ?>
                    </p>
                    <a href="https://<?php echo $person->website;  ?>" target="_blank">
                    <?php echo $person->website;  ?>
                    </a>
                </div>
            </div>
        </section>
        <?php endforeach ?>
    </main>