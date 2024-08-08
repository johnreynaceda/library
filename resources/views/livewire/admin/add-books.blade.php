<div class="p-6 bg-white shadow-md rounded-lg mt-12">
    <div class="flex justify-end">
        <x-button label="Add Books" wire:click="$set('add_modal', true)" class="w-64 slate"/>
    </div>
    <h2 class="text-2xl font-semibold mb-4">Books List</h2>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-4 py-2 border-b">Title</th>
                <th class="px-4 py-2 border-b">ISBN</th>
                <th class="px-4 py-2 border-b">Catalog</th>
                <th class="px-4 py-2 border-b">Author</th>
                <th class="px-4 py-2 border-b">Publisher</th>
                <th class="px-4 py-2 border-b">Category</th>
                <th class="px-4 py-2 border-b">Description</th>
                <th class="px-4 py-2 border-b">Image</th>
                <th class="px-4 py-2 border-b">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border-b">{{ $book->title }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->isbn }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->catalog }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->author }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->publisher }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->category }}</td>
                    <td class="px-4 py-2 border-b">{{ $book->description }}</td>
                    <td class="px-4 py-2 border-b">
                        @if ($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Cover" class="w-16 h-16 object-cover rounded">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b">
                        <button wire:click="edit({{ $book->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                        <button wire:click="delete({{ $book->id }})" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-2 text-center text-gray-500">No books found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $books->links() }}
    </div>

    <!-- Add Book Modal -->
    <x-modal-card title="Add New Book" name="add_modal" wire:model.defer="add_modal">
        <div class="space-y-3">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" id="isbn" wire:model.defer="isbn" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('isbn') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="catalog" class="block text-sm font-medium text-gray-700">Catalog</label>
                <input type="text" id="catalog" wire:model.defer="catalog" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('catalog') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" id="author" wire:model.defer="author" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                <input type="text" id="publisher" wire:model.defer="publisher" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('publisher') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" wire:model.defer="category" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" disabled selected>Select a category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="Biography">Biography</option>
                    <option value="Fantasy">Fantasy</option>
                </select>
                @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" wire:model.defer="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" id="image" wire:model="image" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="Save" wire:click="submit" />
            </div>
        </x-slot>
    </x-modal-card>

    <!-- Edit Book Modal -->
    <x-modal-card title="Edit Book" name="edit_modal" wire:model.defer="edit_modal">
        <div class="space-y-3">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                <input type="text" id="isbn" wire:model.defer="isbn" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('isbn') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="catalog" class="block text-sm font-medium text-gray-700">Catalog</label>
                <input type="text" id="catalog" wire:model.defer="catalog" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('catalog') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" id="author" wire:model.defer="author" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('author') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-700">Publisher</label>
                <input type="text" id="publisher" wire:model.defer="publisher" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('publisher') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" wire:model.defer="category" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" disabled selected>Select a category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science">Science</option>
                    <option value="History">History</option>
                    <option value="Biography">Biography</option>
                    <option value="Fantasy">Fantasy</option>
                </select>
                @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" wire:model.defer="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" id="image" wire:model="image" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="Update" wire:click="update" />
            </div>
        </x-slot>
    </x-modal-card>
</div>
