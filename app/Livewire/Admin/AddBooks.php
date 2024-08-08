<?php

namespace App\Livewire\Admin;
use WireUi\Traits\WireUiActions;
use Livewire\WithFileUploads;
use App\Models\books as Books;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddBooks extends Component
{
    use WireUiActions;
    use WithFileUploads;
    public $add_modal = false;
    public $edit_modal = false;
    public $title;
    public $isbn;
    public $catalog;
    public $author;
    public $publisher;
    public $category;
    public $description;
    public $image;
    public $bookId;
    public $editBook;
    protected $rules = [
        'title' => 'required|string|max:255',
        'isbn' => 'required|string|max:13',
        'catalog' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
    ];
    public function render()
    {
        $books = Books::paginate(8);
        return view('livewire.admin.add-books', compact('books'));
    }

    public function submit()
    {

        $this->validate();


        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('books', 'public');
        }


        Books::create([
            'title' => $this->title,
            'isbn' => $this->isbn,
            'catalog' => $this->catalog,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'category' => $this->category,
            'description' => $this->description,
            'image' => $imagePath,
        ]);


        $this->reset([
            'title',
            'isbn',
            'catalog',
            'author',
            'publisher',
            'category',
            'description',
            'image',
        ]);


        $this->add_modal = false;


        flash()->success('Success', [
            'message' => 'Book added successfully.',
            'title' => 'Success',
        ]);
    }

    public function edit($id)
    {
        $this->editBook = Books::find($id);
        $this->bookId = $id;
        $this->title = $this->editBook->title;
        $this->isbn = $this->editBook->isbn;
        $this->catalog = $this->editBook->catalog;
        $this->author = $this->editBook->author;
        $this->publisher = $this->editBook->publisher;
        $this->category = $this->editBook->category;
        $this->description = $this->editBook->description;
        $this->edit_modal = true;
    }

    public function update()
    {
        $this->validate();

        $book = Books::find($this->bookId);

        if ($this->image) {

            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $imagePath = $this->image->store('books', 'public');
        } else {
            $imagePath = $book->image;
        }

        $book->update([
            'title' => $this->title,
            'isbn' => $this->isbn,
            'catalog' => $this->catalog,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'category' => $this->category,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $this->reset([
            'title',
            'isbn',
            'catalog',
            'author',
            'publisher',
            'category',
            'description',
            'image',
        ]);

        $this->edit_modal = false;
        flash()->success('Success', [
            'message' => 'Book updated successfully.',
            'title' => 'Success',
        ]);
    }

    public function delete($id)
    {
        $book = Books::find($id);


        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();
        flash()->success('Success', [
            'message' => 'Book deleted successfully.',
            'title' => 'Success',
        ]);
    }

}
