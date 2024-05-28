

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
                Created_at
            </th>
            <th scope="col" class="px-6 py-3">
                Updated_at
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4  w-12">
                    <img class="h-8 w-8 rounded-full object-cover " src="{{ $category->profile_photo_url }}" alt="{{ $category->name }}" style="min-width: 35px" />
                </td>
                <td class="px-6 py-4 ">
                    {{ $category->name }}
                </td>
                <td class="px-6 py-4 ">
                    {{ $category->created_at }}
                </td>
                <td class="px-6 py-4 ">
                    {{ $category->updated_at }}
                </td>
                <td class="px-6 py-4 ">
                    <a href="{{route('categories.edit', $category->id)}}" class="font-medium text-orange-600 dark:text-blue-500 hover:underline">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <a href="{{route('categories.destroy', $category->id)}}" class="font-medium text-red-600 dark:text-blue-500 hover:underline" onclick="return onCategoryDelete()">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-6" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">{{($categories->currentPage()-1)*$categories->perPage()+1}}-{{($categories->currentPage()-1)*$categories->perPage()+$categories->perPage()}}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{$categories->total()}}</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            @if($categories->previousPageUrl()!==null)
                <li>
                    <a href="{{$categories->previousPageUrl()}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            @endif

            @for($index=1; $index<=$categories->lastPage(); $index++)
                    <li>
                        <a href="{{$categories->url($index)}}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" style="{{$categories->currentPage()===$index ? 'background-color:blue; color:white' : ''}}">{{$index}}</a>
                    </li>
            @endfor

            @if($categories->nextPageUrl()!==null)
                <li>
                    <a href="{{$categories->nextPageUrl()}}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
<script>
    function onCategoryDelete(){
        return confirm('are you sure you want to delete');
    }
</script>
