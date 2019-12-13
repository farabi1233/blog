<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Str;
use Session;

class BlogController extends Controller
{
    
    public function index()
    {
        $data['blogs'] = Blog::with(['category'])->orderBy('id', 'desc')->get();
        //return $data['blogs'];

        return view('web.blog_list')->with($data);
        ;
    }

    
    public function create()
    {
        $data['categories'] =  Category::orderBy('category_name')->get();

        return view('web.add_blog')->with($data);
    }

    
    public function store(Request $request)
    {
        $blogData = $this->validateRequest();
        $blogData['slug'] = Str::slug($request->blog_title);
        if ($request->hasFile('image')) {

            $blogData['image'] = $this->uploadImage($request->file('image'));
        }
        if (Blog::create($blogData)) {
            Session::flash('response', array('type' => 'success', 'message' => 'New Blog Added successfully!'));
        } else {
            Session::flash('response', array('type' => 'error', 'message' => 'Something Went wrong!'));
        }

    }

   
    public function show($id)
    {
        $data=[

            'blog' =>  Blog::find($id)
        ];
        

       return view('web.show_blog')->with($data);
    }

    
    public function edit(BLog $blog)
    
    {
        $data['categories'] =  Category::orderBy('category_name')->get();
        $data['blog']= $blog;
        return view('web.edit')->with($data);
    }

   
    public function update(Request $request,BLog $blog)
    {

        echo 'yes';
        // exit;
        $blogData = $this->validateRequest();
        
        if ($request->hasFile('image')) {

            $blogData['image'] = $this->uploadImage($request->file('image'),$blog);
        }  
        $blogData['blog_title'] = $request->blog_title;
        $blogData['blog_description'] = $request->blog_description;
        $blogData['category_id'] = $request->category_id;


        if ($blog->update($blogData)) {
            Session::flash('response', array('type' => 'success', 'message' => ' Blog Updated successfully!'));
            return redirect(route('blog.show',$blog->id));
        } else {
            Session::flash('response', array('type' => 'error', 'message' => 'Something Went wrong!'));
        }
      
    
    }

    
    public function destroy($id)
    {
        //
    }
    private function uploadImage($image)
    {
        $timestemp = time();
        $imageName = $timestemp . '.' . $image->getClientOriginalExtension();

        $path = public_path('storage/uploads/blog/') . 'image_' . $imageName;
        Image::make($image)->save($path);
        return 'image_' . $imageName;
    }
    private function updateImage($image, $blog)
    {
        if (file_exists(storage_path('storage/uploads/blog/' . $blog->image))) {
            unlink(storage_path('storage/uploads/blog/' . $blog->image));
        }
        $timestemp = time();
        $imageName = $timestemp . '.' . $image->getClientOriginalExtension();
        $path = public_path('storage/uploads/blog/') . 'image_' . $imageName;
        Image::make($image)->save($path);
        return 'image_' . $imageName;
    }


    private function validateRequest()
    {
        return request()->validate([
            'blog_title'    => 'required',
            'category_id'   => 'required',
            'blog_description' => 'required',
            'image' => 'sometimes|image|max:5000',
        ]);
    }
}
