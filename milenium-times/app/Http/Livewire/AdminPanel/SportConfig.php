<?php

namespace App\Http\Livewire\AdminPanel;

use App\Models\Pages;
use Livewire\Component;
use Livewire\WithFileUploads;

class SportConfig extends Component
{
    use WithFileUploads;

    public $PAGE_ID = 1;

    // Binding Variable
    public $pages;

    public $image;
    public $image_update;
    public $upload_status;

    protected $rules = [
        'image_update' => 'nullable|image|mimes:png,jpeg,jpg,svg',
    ];

    public function updatedImageUpdate() {
        $this->validate();
        $this->image = $this->image_update;
        $this->upload_status = true;
    }

    public function mount() {
        $this->pages = Pages::find($this->PAGE_ID);
        $this->image = $this->pages->wallpaper_img;
        $this->upload_status = false;
        $this->image_update = null;
    }

    public function render()
    {
        return view('livewire.admin-panel.sport-config')->layout('layouts.admin');
    }

    public function save_changes() {
        if ($this->image) {
            if ($this->upload_status) {
                if ($this->pages->wallpaper_img != null) {
                    if (file_exists(public_path() . '/storage/'. $this->pages->wallpaper_img)) {
                        unlink(public_path() . '/storage/'. $this->pages->wallpaper_img);
                    }
                }
                $this->pages->wallpaper_img = $this->image->store('page_wallpaper');
                $this->pages->save();
                return redirect(request()->header('Referer'))->with('message', 'Wallpaper berhasil diubah!');
            }
        }
    }

}
