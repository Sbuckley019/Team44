<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { onMounted, ref, shallowRef } from "vue";
import SliderBox from "@/Components/SliderBox.vue";
import SliderButton from "@/Components/SliderButton.vue";
import Slider from "@/Components/Slider.vue";
import RegisterForm from "@/Features/Auth/RegisterForm.vue";
import LoginForm from "@/Features/Auth/LoginForm.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";

const sliderPosition = ref("left");

const setSliderPosition = (position) => {
    sliderPosition.value = position;
};

const currentComponent = shallowRef(LoginForm);

const showComponent = (component) => {
    setTimeout(() => {
        currentComponent.value =
            component === "login" ? LoginForm : RegisterForm;
    }, 200);
};
</script>
<template>
    <AuthLayout>
        <div class="flex mb-8">
            <Link href="/" class="mx-auto">
                <ApplicationLogo class="w-32 h-32" />
            </Link>
        </div>
        <SliderBox>
            <Slider :position="sliderPosition" />
            <SliderButton
                buttonText="Log In"
                @handle-click="
                    setSliderPosition('left');
                    showComponent('login');
                "
            />
            <SliderButton
                buttonText="Sign Up"
                @handle-click="
                    setSliderPosition('right');
                    showComponent('register');
                "
            />
        </SliderBox>
        <component :is="currentComponent" />
    </AuthLayout>
</template>
