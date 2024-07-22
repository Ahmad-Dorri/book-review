<x-layout>
    <h1 class="mb-10 text-2xl">
        Books
    </h1>
    <form class="flex gap-2 mb-4 items-center" method="get" action="{{ route('books.index') }}">
        <input name="title" class="input h-10" type="text" placeholder="Search Your Book from here..."
               value="{{ request('title') }}"/>
        <input type="hidden" name="filter"  value="{{ request('filter') }}" />
        <button class="btn h-10" type="submit">
            search
        </button>
        <a class="btn h-10" href="{{ route('books.index') }}">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
                '' => 'latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6_months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_last_6_months' => 'Highest Rated Last 6 Months',
            ];
        @endphp
        @foreach($filters as $key => $label)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"  @class(['filter-item', 'filter-item-active' => request('filter') === $key || (request('filter') === null && $key === '')]) >
                {{ $label }}
            </a>
        @endforeach
    </div>

    <ul>
        @forelse($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div
                            class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">
                                {{ $book->title }}
                            </a>
                            <span class="book-author">by {{ $book->author->name }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                {{ number_format($book->reviews_avg_rating, 1) }}
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="#" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
</x-layout>
