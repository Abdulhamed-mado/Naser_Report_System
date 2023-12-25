<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=IBM+Plex+Sans+Arabic:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <link rel="stylesheet" href="dist/paper.css">

    <style>
        @page {
            size: A4
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title> {{ config('app.name', 'Laravel') }} </title>
</head>

<body class="A4">
    <section class="sheet ">
        <article>

            <div class="flex justify-center py-6 bg-gradient-to-b from-green-100 to-sky-transparent">
                <img class="w-24" src="{{ asset('images/Nasr_Benghazi.png') }}" alt="logo">
            </div>

            <div class="">
                <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">

                            <div class="text-center  mb-4   bg-opacity-75">


                                <h2 class="text-xl "> تقرير <b> {{ $current_month }} {{ $current_year }} </b> </h2>
                            </div>

                            {{-- <div class="mb-2">
                                <span class="font-bold">السيد / {{ $head->name }} </span><br>
                                <span>مدير {{ $faculty->name }}</span>
                            </div> --}}
                            <div class="mb-4">
                                <div class="bg-gradient-to-b from-green-50 via-teal-50 to-teal-transparent    p-2 ">
                                    <span class="font-bold">اسم المدرب </span> : {{ $couch->name }}<br>
                                </div>
                                <span class="font-bold">يدرب فريق</span> : {{ $couch->repForTeam }}<br>
                                <span class="font-bold">الخطة شهر</span> : {{ $plan->report_month }}<br>
                                <span class="font-bold">الخطة اسبوع</span> : {{ $plan->report_week }}<br>
                            </div>
                            <div class="bg-gradient-to-b from-green-50 via-gray-50 to-gray-50   p-2 rounded-t-md">
                                <span class="font-bold ">
                                    خطة التدريب
                                </span>
                            </div>
                            <div class="mb-8">

                                <p class="text-lg font-medium text-gray-800 mb-4">
                                    {{ $plan->plan }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </article>
    </section>
</body>

</html>
