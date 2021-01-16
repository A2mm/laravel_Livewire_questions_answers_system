<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Answer;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Facades\Auth;

class Answers extends Component
{
    use WithPagination;
	// public $commentss;
	public $newAnswer;
	public $image;
	public $questionId;

	protected $listeners = [
        'fileUpload'     => 'handleFileUpload',
        'questionSelected',
    ];

	public function storeImage()
    {
        if (!$this->image) {
            return null;
        }

        $img   = ImageManagerStatic::make($this->image)->encode('jpg');
        $name  = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function questionSelected($questionId)
    {
        $this->questionId = $questionId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
	public function addAnswer()
	{
		$this->validate([
			'newAnswer' => 'required|min:5',
		]);

		if ($this->questionId == '') {
			return;
		}

		// $this->commentss->prepend($insertedComment);
		// $this->commentss->push($insertedComment);

		$image          = $this->storeImage();
        $createdAnswer = Answer::create([
            'body'              => $this->newAnswer, 
            'user_id'           => Auth::user()->id,
            'image'             => $image,
            'question_id'       => $this->questionId,
        ]);
        $this->newAnswer  = '';
        $this->image      = '';
        session()->flash('message', 'answer added successfully');
	}

	public function remove($id)
	{	
		$deletedAnswer = Answer::find($id);
		$deletedAnswer->delete();
		Storage::disk('public')->delete($deletedAnswer->image);
		// $this->commentss = $this->commentss->except($id);
		session()->flash('message', 'answer deleted successfully');
	}
/*
	public function mount()
	{
		$initialComments = Comment::orderBy('created_at', 'desc')->get();
		$this->commentss = $initialComments;
	}
*/

    public function render()
    {
    	 return view('livewire.answers', [
            'answers' => Answer::where('question_id', $this->questionId)->latest()->paginate(2),
        ]);
    }
}
