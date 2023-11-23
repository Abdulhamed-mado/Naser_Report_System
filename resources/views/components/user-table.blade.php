<div class="p-4">
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden border rounded-lg text right">
                    <table class="min-w-full divide-y divide-neutral-200">
                        <thead class="bg-neutral-50">
                            <tr class="text-neutral-500">
                                <th class="px-5 py-3 text-xs font-medium text-right ">رقم الموظف</th>
                                <th class="px-5 py-3 text-xs font-medium text-right ">اســــم الموظف</th>
                                <th class="px-5 py-3 text-xs font-medium text-right ">البريد الاكتروني</th>
                                <th class="px-5 py-3 text-xs font-medium text-right ">المسمة الوظيفي</th>
                                <th class="px-5 py-3 text-xs font-medium text-right ">تاريخ بداية التعاقد</th>

                                <th class="px-5 py-3 text-xs font-medium text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 text right">
                            @foreach($users as $user)
                            <tr class="text-neutral-800">
                                <td class="px-5 py-4 text-sm font-medium whitespace-nowrap">{{$user->id}}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{$user->name}}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{$user->email}}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{$user->role}}</td>
                                <td class="px-5 py-4 text-sm whitespace-nowrap">{{$user->repForTeam}}</td>

                                <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
    <div class="gap-3">
        <span>         
            <button 
    class="inline-flex items-center px-2.5 py-1.5 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
    x-on:click="showEditModal = true"  
    x-transition:enter="transition ease-out duration-300 transform"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    wire:click="lodeEditmodel({{ $user->id }})">

    تعديل
</button>
        </span>
        <button 
        onclick="confirm('هل تريد حذف المستخدم?') || event.stopImmediatePropagation()"
            wire:click="deleteuser({{ $user->id }})" 
            class="inline-flex items-center px-2.5 py-1.5 border border-red-500 rounded-md font-semibold text-xs text-red-500 bg-white hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
        >
            حذف
        </button>
    </div>
</td>
                            </tr>
                            @endforeach

                            @if ($Editloaded)
{{-- here start the add model --}}

<div class="fixed z-10 inset-0 overflow-y-auto"
x-show="showModal"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-300"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0">

<div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
<div class="fixed inset-0 transition-opacity"
aria-hidden="true"
x-show="showModal"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0"
x-transition:enter-end="opacity-100"
x-transition:leave="transition ease-in duration-300"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0">
<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
</div>

<span class="hidden sm:inline-block sm:align-middle sm:h-screen"
 aria-hidden="true">&#8203;</span>

<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
x-show="showModal"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
x-transition:leave="transition ease-in duration-300"
x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 ">
   <div class="sm:flex sm:items-start">
    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
        <h3 class="text-lg leading-6 font-medium text-gray-900 text-right">
           اضافة موظف
        </h3>

           <div class="mt-2 text-right">
            <form >
                   <div class="mb-4">
                       <label class="block text-gray-700 font-bold mb-2"
                              for="name">
                              اســــم 
                       </label>
                       <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="name"
                              type="text"
                              placeholder="اســــم"
                              
                              wire:model="name">
                              @error('name') <span class="text-red-500">{{ "الرجاء التأكد من ادخال البيانات" }}</span> @enderror

                   </div>

                   <div class="mb-4">
                       <label class="block text-gray-700 font-bold mb-2"
                              for="email">
                           البريد الاكتروني
                       </label>
                       <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="email"
                              type="email"
                              placeholder=" البريد الاكتروني"
                             
                              wire:model="email">
                              @error('email') <span class="text-red-500">{{ "الرجاء التأكد من ادخال البيانات" }}</span> @enderror

                   </div>




                   <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2"
                           for="department_id">
                            مدرب او اداري                                                             
                        </label>
                    <select wire:model="department_id" id="department_id" name="department_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" dir="rtl">
              <option value="">اختر  مدرب او اداري  </option>

              <option value="مدرب">مدرب</option>
              <option value="اداري">اداري</option>

            </select>
                           @error('department_id') <span class="text-red-500">{{ "الرجاء التأكد من ادخال البيانات" }}</span> @enderror

                </div>
                         
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2"
                           for="department_id">
                            مسؤول عن الفئة                                                            
                        </label>
                    <select wire:model="department_id" id="department_id" name="department_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" dir="rtl">
              <option value="">اختر الفئة  </option>

              <option value="U12">تحت 12</option>
              <option value="U14">تحت 14</option>
              <option value="U16">تحت 16</option>
              <option value="U18">تحت 18</option>
              <option value="U20">تحت 20</option>
              <option value="senior">أكابر</option>


            </select>
                           @error('department_id') <span class="text-red-500">{{ "الرجاء التأكد من ادخال البيانات" }}</span> @enderror

                </div>
                 
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2"
                           for="password">
                        كلمة المرور
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           id="password"
                           type="password"
                           placeholder=" كلمة المرور"
                         
                           wire:model="password">
                           @error('password') <span class="text-red-500">{{ "الرجاء التأكد من ادخال البيانات" }}</span> @enderror

                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-800 focus:outlineLet me continue where I left off:-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 sm:ml-3 sm:w-auto sm:text-sm"
                    wire:click.prevent="editUser"   
                    x-on:click="closeModel ? showEditModal = false "  >
                    تعديل
                </button>
                <button class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        x-on:click=" showModal = false"
                        wire:click="propertyReset"  >
                    رجوع
                </button>
           </div>
        </form>

       </div>
   </div>
</div>

</div>
</div>
</div>

{{-- here end the add model sorry for the long code --}}

                            @endif
                            

                        </tbody>

                    
                    </table>

                      


                </div>
            </div>
        </div>
    </div>
</div>