

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="card ">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('products.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Product Ekle</a>
            </h5>
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Name
            </th>
            <th scope="col" class="px-6 py-3">
                Category Name
            </th>
            <th scope="col" class="px-6 py-3">
                Created By
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>
            <th scope="col" class="px-6 py-3">
                Updated At
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                <td class="px-6 py-4 text-center">
                    {{ $product->name }}
                </td>
                <td class="px-6 py-4 text-center">
                    {{ $product->category->name }}
                </td>
                <td class="px-6 py-4 text-center ">
                    {{ $product->user->name }}
                </td>
                <td class="px-6 py-4 text-center ">
                    {{ $product->amount }}
                </td>
                <td class="px-6 py-4 text-center ">
                    {{ $product->updated_at }}
                </td>
                <td class="px-6 py-4 text-center">
                    <a href="{{route('products.changeAmount', [$product->id,'decrease'])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">azalt</a>
                    <span>----</span>
                    <a href="{{route('products.changeAmount', [$product->id,'increase'])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">arttır</a>
                    <span>----</span>
                    <a href="{{route('products.edit', $product->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">update</a>
                    <span>----</span>
                    <a href="{{route('products.destroy', $product->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between p-6" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">{{($products->currentPage()-1)*$products->perPage()+1}}-{{($products->currentPage()-1)*$products->perPage()+$products->perPage()}}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{$products->total()}}</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            @if($products->previousPageUrl()!==null)
                <li>
                    <a href="{{$products->previousPageUrl()}}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
            @endif

            @for($index=1; $index<=$products->lastPage(); $index++)
                    <li>
                        <a href="{{$products->url($index)}}"  class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" style="{{$products->currentPage()===$index ? 'background-color:blue; color:white' : ''}}">{{$index}}</a>
                    </li>
            @endfor

            @if($products->nextPageUrl()!==null)
                <li>
                    <a href="{{$products->nextPageUrl()}}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>

