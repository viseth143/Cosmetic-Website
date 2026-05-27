@extends('layouts.app')

@section('content')
<section class="bg-white py-20">

    <div class="container mx-auto px-6">

        <div class="text-center mb-16">

            <h1 class="text-5xl font-bold text-pink-500 mb-6">
                About Us
            </h1>

            <p class="max-w-3xl mx-auto text-gray-600 text-lg">
                Learn more about GlowSkin and our cosmetic mission.
            </p>

        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center">

            <div>
                <img src="{{ asset('images/us.jpg') }}" alt="About Us"
                    class="w-full h-[500px] object-cover rounded-2xl shadow-lg" />
            </div>

            <div>

                <h2 class="text-3xl font-bold mb-6">
                    Beauty and Confidence Every Day
                </h2>

                <p class="text-gray-600 leading-8 mb-5">
                    At GlowSkin, we create premium cosmetic products designed
                    to enhance your beauty and confidence every day.
                </p>

                <p class="text-gray-600 leading-8 mb-5">
                    Our team carefully selects high-quality ingredients to ensure
                    safe, effective, and modern cosmetic solutions.
                </p>

                <p class="text-gray-600 leading-8">
                    We believe true beauty begins with self-care and confidence.
                </p>

            </div>

        </div>

    </div>

</section>
@endsection