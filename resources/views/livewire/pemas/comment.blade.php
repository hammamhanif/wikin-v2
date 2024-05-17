<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <h4 class="comments-count">Diskusi Komentar ({{ $total_comments }})</h4>
    @guest
        <div class="alert alert-success" role="alert">
            Login / masuk terlebih dahulu untuk berdiskusi <a href="{{ route('login') }}" class="alert-link">Klik di sini</a>.
        </div>
    @endguest

    @foreach ($comments as $comment)
        <div id="comment-{{ $comment->id }}" class="comment">
            <div class="d-flex">
                <div class="comment-img"><img src="{{ asset($comment->user->image ?? 'img/Avatar_Profile.png') }}"
                        alt=""></div>
                <div>
                    <h5><a href="">{{ $comment->user->name }}</a></a>
                    </h5>
                    <time datetime="2020-01-01">{{ $comment->created_at }}</time>
                    <p>
                        {{ $comment->body }}
                    </p>
                    <div>
                        @auth
                            @if ($comment->user_id == Auth::user()->id)
                                <button class="btn btn-outline-warning"
                                    wire:click="selectEdit({{ $comment->id }})">Edit</button>
                            @endif
                            @if ($comment->user_id == Auth::user()->id || Auth::user()->type == 'admin')
                                <button class="btn btn-outline-danger"
                                    wire:click="delete({{ $comment->id }})">Hapus</button>
                            @endif
                            <button class="btn btn-outline-primary" wire:click="selectReply({{ $comment->id }})"
                                type="submit">Balas</button>
                            @if (isset($comment->hasLike))
                                <button class="btn btn-danger" wire:click="like({{ $comment->id }})"><i
                                        class="bi bi-heart-fill"></i>
                                    ({{ $comment->totalLikes() }})
                                </button>
                            @else
                                <button wire:click="like({{ $comment->id }})" class="btn btn-outline-danger"><i
                                        class="bi bi-heart-fill"></i>
                                    ({{ $comment->totalLikes() }})
                                </button>
                            @endif

                        </div>
                    @endauth
                    @if (isset($comment_id) && $comment_id == $comment->id)
                        <form wire:submit.prevent="reply" class="mt-3">
                            <div class="row">
                                <div class="col form-group mb-3">
                                    <textarea wire:model.defer="body2" class="form-control @error('body2') is-invalid
                            @enderror"
                                        placeholder="Tulis Komentar.." minlength="3"></textarea>
                                    @error('body2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Balas</button>
                            </div>
                        </form>
                    @endif
                    @if (isset($edit_comment_id) && $edit_comment_id == $comment->id)
                        <form wire:submit.prevent="change" class="mt-3">
                            <div class="row">
                                <div class="col form-group mb-3">
                                    <textarea wire:model.defer="body2"
                                        class="form-control @error('body2') is-invalid
                                @enderror"
                                        placeholder="Tulis Komentar.." minlength="3"></textarea>
                                    @error('body2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Kirim</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        @if ($comment->childrens)
            @foreach ($comment->childrens as $comment2)
                {{-- balasan --}}
                <div id="comment-1" class="comment ms-5">
                    <div class="d-flex">
                        <div class="comment-img"><img
                                src="{{ asset($comment2->user->image ?? 'img/Avatar_Profile.png') }}" alt="">
                        </div>
                        <div>
                            <h5><a href="">{{ $comment2->user->name }}</a></a>
                            </h5>
                            <time datetime="2020-01-01">{{ $comment2->created_at }}</time>
                            <p>
                                {{ $comment2->body }}
                            </p>
                            <div>
                                @auth
                                    @if ($comment2->user_id == Auth::user()->id)
                                        <button class="btn btn-outline-warning"
                                            wire:click="selectEdit({{ $comment2->id }})">Edit</button>
                                        <button class="btn btn-outline-danger"
                                            wire:click="delete({{ $comment2->id }})">Hapus</button>
                                    @endif
                                    <button class="btn btn-outline-primary" wire:click="selectReply({{ $comment2->id }})"
                                        type="submit">Balas</button>
                                    @if (isset($comment2->hasLike))
                                        <button class="btn btn-danger" wire:click="like({{ $comment2->id }})"><i
                                                class="bi bi-heart-fill"></i>
                                            ({{ $comment2->totalLikes() }})
                                        </button>
                                    @else
                                        <button wire:click="like({{ $comment2->id }})" class="btn btn-outline-danger"><i
                                                class="bi bi-heart-fill"></i>
                                            ({{ $comment2->totalLikes() }})
                                        </button>
                                    @endif
                                @endauth
                            </div>
                            @if (isset($comment_id) && $comment_id == $comment2->id)
                                <form wire:submit.prevent="reply" class="mt-3">
                                    <div class="row">
                                        <div class="col form-group mb-3">
                                            <textarea wire:model.defer="body2" class="form-control @error('body2') is-invalid
                            @enderror"
                                                placeholder="Tulis Komentar.." minlength="3"></textarea>
                                            @error('body2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Balas</button>
                                    </div>
                                </form>
                            @endif
                            @if (isset($edit_comment_id) && $edit_comment_id == $comment2->id)
                                <form wire:submit.prevent="change" class="mt-3">
                                    <div class="row">
                                        <div class="col form-group mb-3">
                                            <textarea wire:model.defer="body2"
                                                class="form-control @error('body2') is-invalid
                                @enderror"
                                                placeholder="Tulis Komentar.." minlength="3"></textarea>
                                            @error('body2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-warning">Kirim</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                    <!-- End balasant #1 -->
                </div>
            @endforeach
            <hr>
        @endif
    @endforeach

    @auth
        <div class="reply-form">

            <h4>Tambahkan Diskusi</h4>

            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col form-group">
                        <textarea wire:model.defer="body" class="form-control @error('body') is-invalid
                @enderror"
                            placeholder="Tulis Komentar.." minlength="3"></textarea>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>


        </div>
    @endauth


</div>
