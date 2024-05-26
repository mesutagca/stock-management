

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>

            <th scope="col" class="px-6 py-3">

            </th>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Role
            </th>
            <th scope="col" class="px-6 py-3">
                Status
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                <td class="px-6 py-4 text-center w-12">
                    <img class="h-8 w-8 rounded-full object-cover " src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" style="min-width: 35px" />
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4 text-center ">
                    {{ $user->role }}
                </td>
                <td class="px-6 py-4 text-center">
                  <span class="{{$user->approved ? 'text-green-500' : 'text-red-500'}}">
                      {{$user->approved ? 'active' : 'pending'}}
                  </span>
                </td>

                <td class="px-6 py-4 text-center">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-6" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">{{($users->currentPage()-1)*$users->perPage()+1}}-{{($users->currentPage()-1)*$users->perPage()+$users->perPage()}}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{$users->total()}}</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            @if($users->previousPageUrl()!==null)
                <li>
                    <a href="{{$users->previousPageUrl()}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            @endif

            @for($index=1; $index<=$users->lastPage(); $index++)
                    <li>
                        <a href="{{$users->url($index)}}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" style="{{$users->currentPage()===$index ? 'background-color:blue; color:white' : ''}}">{{$index}}</a>
                    </li>
            @endfor

            @if($users->nextPageUrl()!==null)
                <li>
                    <a href="{{$users->nextPageUrl()}}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>

