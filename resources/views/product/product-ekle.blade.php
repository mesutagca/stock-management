<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($product))
                {{ __('Product Düzenle') }}
            @else
                {{ __('Product Ekle') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form class="max-w-sm mx-auto" method="POST" action="{{isset($product) ? route('products.update', $product->id) : route('products.store')}}" enctype="multipart/form-data">

                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif

                    <div class="mb-5">
                    <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select category</label>
                    <select id="categories" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($categories as $category)
                            <option
                               @if(isset($product) && $category->id==$product->category_id) selected @endif
                                value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                    </div>

                    <div class="mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="product-name" required value="{{$product->name ?? ''}}" />
                    </div>
                    <div class="mb-5">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Amount</label>
                        <input type="text" id="amount" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="product-amount" required value="{{$product->amount ?? 1}}" />
                    </div>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
                        <img src="{{isset($product) && $product->profile_photo_path ? $product->profile_photo_url : \Illuminate\Support\Facades\Storage::url('images/no-preview.jpeg')}}" alt="preview" id="preview" class="p-1 mb-3 border border-gray-300 rounded-lg" style="max-width:100px;">
                        <input onchange="onPhotoChanged(event)" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="photo" type="file" name="photo">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Add Product Picture</div>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    <button type="button" onclick="location.href='{{route('products.index')}}'" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function onPhotoChanged(event){
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
