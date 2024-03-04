<div class='business-card-covers'>
    <div class='business-card business-card-front'>
        <div class="brand">
            <img src="<?php echo $worker->getCompany()->getLogoUrl(); ?>" alt="Logo">
        </div>
        <div class="company-info">
            <p><i class="fa-solid fa-location-dot"></i> <?php echo $worker->getCompany()->getFullAddress(); ?></p>
            <p><i class="fa-solid fa-globe"></i> <a href="<?php echo $worker->getCompany()->getWebsite(); ?>">mews.com</a></p>
        </div>
    </div>
    <div class='business-card business-card-back'>
        <div class="person-info">
            <h1><?php echo $worker->getFullName(); ?></h1>
            <h2 class="role"><?php echo $worker->getJobTitle(); ?></h2>
            <hr class="divider">
            <p><i class="fa-solid fa-cake-candles"></i> <?php echo $worker->getDateOfBirth(); ?></p>
            <p><i class="fa-solid fa-hourglass-half"></i> <?php echo $worker->getAge(); ?> years</p>
            <p><i class="fa-solid fa-at"></i> <a href="mailto:<?php echo $worker->getEmail(); ?>"><?php echo $worker->getEmail(); ?></a></p>
            <p><i class=" fa-solid fa-phone"></i> <?php echo $worker->getPhone(); ?></p>
            <p><i class="fa-solid fa-briefcase"></i> <?php echo $worker->isLookingForJob() ? "Looking for work" : "Not looking for work"; ?></p>
        </div>
        <div class="brand">
            <img src="<?php echo $worker->getCompany()->getLogoUrl(); ?>" alt="Logo">
        </div>
    </div>
</div>