<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        ActivityService::log('بەکارهێنەر', 'سەیری لیستی بەکارهێنەرانی کرد', auth()->id(), 'blue');
        $users =  User::OfSearch($request->input('search'))->orderByDesc('id')->paginate(15)->withQueryString();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        ActivityService::log('بەکارهێنەر', 'فۆرمی دروستکردنی بەکارهێنەری کردەوە', auth()->id(), 'orange');
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $request->file('image')->hashName();
            $request->file('image')->move('user_images', $image);
            $data["image"] = $image;
        }
        User::create($data);
        ActivityService::log('بەکارهێنەر', 'بەکارهێنەرێکی زیادکرد', auth()->id(), 'green');
        return redirect()->route('users.index')->with('success', 'بەکارهێنەر زیادکرا بە سەرکەوتووی');
    }
    public function show(user $user)
    {
        ActivityService::log('بەکارهێنەر', 'سەیری وردەکاری بەکارهێنەری کرد', auth()->id(), 'blue');
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        ActivityService::log('بەکارهێنەر', 'فۆرمی دەسکاریکردنی بەکارهێنەری کردەوە', auth()->id(), "orange");
        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $image = $this->handleImageUpload($request, $user);
        if ($image) {
            $data['image'] = $image;
        }
        $user->update($data);
        ActivityService::log('بەکارهێنەر', 'زانیاریەکانی بەکەرهێنارێکی تازاکردەوە', auth()->id(), 'green');
        return redirect()->route('users.index')->with('success', 'زانیاریەکانی بەکارهێنەر تازەکرایەوە بە سەرکەوتووی');
    }

    public function destroy(User $user, Request $request)
    {
        $imagePath = 'user_images/' . $user->image;
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
        if ($user->permissions == "admin") {
            return redirect()->back()->with('error', 'ناتوانیت ئەدمین بسڕیەوە');
        }
        $user->delete();
        ActivityService::log('بەکارهێنەر', 'بەکارهێنەرێکی سڕیەوە', auth()->id(), "red");
        return redirect()->back()->with('success', 'بەکارهێنەر سڕایەوە بە سەرکەوتووی');
    }

    public function profileEdit()
    {
        ActivityService::log('بەکارهێنەر', 'سەیری پڕۆفایلی خۆی کرد', auth()->id(), 'blue');
        return view('user.ProfileEdit');
    }
    public function profileUpdate(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', 'User not found');
        }
        if ($request->input('num') == 'form1') {
            $data = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'image' => 'sometimes|image|mimes:png,jpg,jpeg',
            ]);
            $image = $this->handleImageUpload($request, $user);
            if ($image) {
                $data['image'] = $image;
            }
            $user->update($data);
            ActivityService::log('بەکارهێنەر', 'زانیاریەکانی پڕۆفایلی خۆی تازەکردەوە', auth()->id(), "green");
            return back()->with('success', 'زانیاریەکانت نوێ کرایەوە بە سەرکەوتووی');
        } elseif ($request->input('num') == 'form2') {
            $data = $request->validate([
                'currentPassword' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);
            if (!Hash::check($data['currentPassword'], $user->password)) {
                return back()->with('error', 'وشەی نهێنی ئێستا هەڵەیە');
            }
            $user->update(['password' => bcrypt($data['password'])]);
            ActivityService::log('بەکارهێنەر', 'زانیاریەکانی پڕۆفایلی خۆی تازەکردەوە', auth()->id(), "green");

            return back()->with('success', 'وشە نهێنیەکەت بە سەرکەوتووی گۆڕا');
        } else {
            return back()->with('error', 'هەڵەیەک ڕووویدا، دواتر هەوڵبدەوە...');
        }
    }
    private function handleImageUpload(Request $request, User $user)
    {
        if ($request->hasFile('image')) {
            $oldImagePath = 'user_images/' . $user->image;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $image = $request->file('image')->hashName();
            $request->file('image')->move('user_images', $image);
            return $image;
        }
        return null;
    }
}
