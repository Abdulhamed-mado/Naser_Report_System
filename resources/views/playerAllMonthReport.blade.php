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
    <title>{{ config('app.name', 'Laravel') }}</title>
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
                                    <span class="font-bold">اسم الاعب </span> : {{ $player->name }}<br>
                                </div>
                                <span class="font-bold">يلعب في فريق</span> : {{ $player->team }}<br>
                                <span class="font-bold">يلعب في مركز</span> : {{ $player->position }}<br>

                            </div>
                            <div class="bg-gradient-to-b from-green-50 via-gray-50 to-gray-50   p-2 rounded-t-md">
                                <span class="font-bold ">
                                    مستوى الاداء و الحضور </span>
                            </div>
                            <div class="mb-8">

                                <table class="min-w-full divide-y divide-gray-200 text-right rounded-b-md table-fixed">
                                    <thead class="bg-gradient-to-b from-gray-50 to-gray-transparent">
                                        <tr>
                                            <th
                                                class="px-1 py-2 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                                #
                                            </th>
                                            <th
                                                class="px-1 py-2 text-xs font-medium tracking-wider  text-gray-500 uppercase text-right">
                                                اسم الاعب
                                            </th>
                                            <th
                                                class="px-1 py-2 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                                التقارير شهر
                                            </th>
                                            <th
                                                class="px-1 py-2 text-xs font-medium tracking-wider  text-center text-gray-500 uppercase">
                                                متوسط الحضور
                                            </th>
                                            <th
                                                class="px-1 py-2 text-xs font-medium tracking-wider  text-center text-gray-500 uppercase">
                                                متوسط الاداء
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @php
                                            $i = 0;
                                        @endphp

                                        {{-- @dd($reports) --}}

                                        @foreach ($reports as $report)
                                            <tr>
                                                <td
                                                    class="px-2 py-2 text-sm font-medium text-gray-900 whitespace-nowrap text-center">
                                                    {{ $i + 1 }}
                                                </td>
                                                <td class="px-2 py-2 text-xs text-gray-900   text-right h-auto">
                                                    {{ $player->name }}
                                                </td>
                                                <td
                                                    class="px-2 py-2 text-xs text-gray-900 whitespace-nowrap text-center">
                                                    {{ $report->report_month }}
                                                </td>
                                                <td
                                                    class="px-2 py-2 text-xs text-gray-900 whitespace-nowrap text-center">
                                                    {{ $attendance }}
                                                </td>
                                                <td
                                                    class="px-2 py-2 text-sm text-gray-900 whitespace-nowrap text-center">
                                                    {{ $preformances }}
                                                </td>

                                            </tr>

                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </article>
    </section>
</body>

</html>
