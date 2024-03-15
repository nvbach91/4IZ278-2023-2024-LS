<div>
<?php foreach($people as $person) : ?>
    <div class="business-card-container">
            <div class="business-card" style="background-image: url(<?php echo $person->businessCardBackground; ?>);">
                <div class="profile">
                    <img class="avatar" src="<?php echo $person->avatarUrl; ?>" alt="avatar">
                    <div class="name-and-job">
                        <div class="name">
                            <div class="first-name"><?php echo $person->firstName;?></div>
                            <div class="last-name"><?php echo $person->lastName;?></div>
                        </div>
                        <div lass="job"><?php echo $person->job;?></div>
                    </div>
                </div>
                <div class="company-name"><?php echo $person->companyName;?></div>
                <div class="contact-info">
                    <div class="phone-number"><?php echo $person->phoneNumber;?></div>
                    <div class="email"><?php echo $person->email;?></div>
                    <div class="web"><?php echo $person->web;?></div>
                </div>
                <div class="address">
                    <div class="street"><?php echo $person->streetName . ' ' . $person->streetNumber;?></div>
                    <div class="reference-number"><?php echo $person->referenceNumber;?></div>
                    <div class="city"><?php echo $person->city;?></div>
                </div>
                <div class="looking-for-job"><?php echo $person->lookingForJob ? 'I am looking for a job!' : 'I am not looking for a job'; ?></div>
        </div>
    </div>
    <?php endforeach; ?>
</div>