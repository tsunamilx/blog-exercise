<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller {

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user) {
        $this->authorize('update', $user);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($password = $request->input('password')) {
            $user->password = bcrypt($password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->storePubliclyAs(
                'public/users',
                md5($user->name) . '.' . $image->guessExtension()
            );
            $user->image = $path;
        }

        $user->save();

        return redirect()->route('users_show', ['user' => $user->id]);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $this->authorize('update', $user);

        $user->delete();
        auth()->logout();

        return redirect()->route('posts_index');
    }
}
