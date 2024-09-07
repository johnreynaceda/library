<div>

    <section>
        <div class="px-8 py-12 mx-auto md:px-12 lg:px-32 max-w-7xl">
          <div class="grid items-center grid-cols-1 gap-4 list-none lg:grid-cols-2 lg:gap-24">
            <div>
              <span class="text-xs font-bold tracking-wide text-gray-500 uppercase">Library System</span>
              <p class="mt-8 text-4xl font-semibold tracking-tight text-gray-900">
                Your gateway to a world of knowledge
              </p>
              <p class="mt-4 text-base font-medium text-gray-500">
                Explore our extensive collection of books and resources. With our streamlined borrowing system, you can easily check out books, manage your reading list, and stay updated with the latest arrivals.
              </p>
              <div class="flex flex-col items-center gap-2 mx-auto mt-8 md:flex-row">
               <a href="{{route('books')}}">
                <button class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 font-medium text-white duration-200 bg-gray-900 md:w-auto rounded-xl hover:bg-gray-700 focus:ring-2 focus:ring-offset-2 focus:ring-black" aria-label="Primary action">
                    Borrow a Book
                   </button>
               </a>
                <a href="{{route('bb')}}">
                    <button class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 font-medium duration-200 bg-gray-100 md:w-auto rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" aria-label="Secondary action">
                        View Collection
                       </button>
                </a>
              </div>
            </div>
            <div class="p-2 border bg-gray-50 rounded-3xl">
              <div class="h-full overflow-hidden bg-white border shadow-lg rounded-3xl">
                <img alt="Library thumbnail" class="relative w-full rounded-2xl drop-shadow-2xl" src="{{asset('images/library.jpg')}}">
              </div>
            </div>
          </div>
        </div>
      </section>



</div>
