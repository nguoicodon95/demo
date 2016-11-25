<template>
    <div class="row cronjob" id="cronjob">
        <div class="col-md-4">
            <div class="card form-stack" id="step-1" data-target="step-1">
                <div class="header">
                    <p class="category">Step 1</p>
                    <h4 class="title">Start with the basics</h4>
                </div>
                <div class="content">
                    Beds, bathrooms, amenities, and more
                    <hr>
                    <a href="{{ link }}" class="btn btn-primary btn-custom" id="submit-step-1">Continue</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card form-stack" id="step-2" data-target="step-2">
                <div class="header">
                    <p class="category">Step 2</p>
                    <h4 class="title">Set the scene</h4>
                </div>
                <div class="content">
                    Beds, bathrooms, amenities, and more
                    <!-- <hr> -->
                    <!-- <button class="btn btn-primary btn-custom">Continue</button> -->
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card form-stack" id="step-3" data-target="step-3">
                <div class="header">
                    <p class="category">Step 3</p>
                    <h4 class="title">Get ready for guests</h4>
                </div>
                <div class="content">
                    Beds, bathrooms, amenities, and more
                    <!-- <hr> -->
                    <!-- <button class="btn btn-primary btn-custom">Continue</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        prop: ['link'],
        ready() {
            //console.log(base_url);
        }
    }
</script>
