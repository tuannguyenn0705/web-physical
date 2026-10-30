{{-- Post Card Component --}}
<article class="relative bg-white rounded-2xl border border-gray-200/90 shadow-xs overflow-hidden hover:shadow-xl hover:border-gray-300 hover:scale-[1.06] hover:-translate-y-1 hover:z-20 transition-all duration-300 ease-out group flex flex-col">
    {{-- Thumbnail --}}
    <a href="{{ route('posts.show', $post->slug) }}" class="block aspect-w-16 aspect-h-9 bg-stone-100 h-48 overflow-hidden relative">
        @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-950 flex flex-col items-center justify-center text-white p-4 group-hover:scale-110 transition-transform duration-500">
                <span class="text-xs font-bold tracking-widest uppercase text-orange-400 font-mono">AI HUB</span>
                <span class="text-[11px] text-slate-400 mt-1 font-medium uppercase tracking-wider">{{ $post->category->name ?? 'Article' }}</span>
            </div>
        @endif
    </a>

    <div class="p-5 flex flex-col flex-grow">
        {{-- Category & Type --}}
        <div class="flex items-center space-x-2 mb-3">
            <span class="inline-block bg-indigo-50 text-indigo-700 border border-indigo-100 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                {{ $post->category->name ?? 'Uncategorized' }}
            </span>
            <span class="text-xs font-medium text-gray-400">
                @switch($post->type)
                    @case('news') News @break
                    @case('review') Review @break
                    @case('tutorial') Tutorial @break
                @endswitch
            </span>
        </div>

        {{-- Title --}}
        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-600 transition">
            <a href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        {{-- Excerpt --}}
        <p class="text-gray-600 text-sm line-clamp-3 mb-4 flex-grow">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
        </p>

        {{-- Meta --}}
        <div class="flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-3">
            <div class="flex items-center space-x-3">
                <span>{{ $post->author->name ?? 'Admin' }}</span>
                <span>{{ $post->published_at?->format('M d, Y') }}</span>
            </div>
            <span>{{ number_format($post->views_count) }} views</span>
        </div>
    </div>
</article>
