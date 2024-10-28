@php
    $breadcrumbs = [['link' => route('home'), 'name' => __('Home')], ['link' => route('dashboard'), 'name' => __('Dashboard')], ['name' => __('Profile')]];
@endphp

<x-app-layout :breadcrumbs="$breadcrumbs">

    <x-slot name="title">{{ 'Profile' }}</x-slot>

    <livewire:dashboard.models.user.profile />

</x-app-layout>
