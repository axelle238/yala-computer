<a href="{{ route('keranjang') }}" class="relative p-2 text-gray-500 hover:bg-gray-100 rounded-full transition">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 5.407c.441 1.889.661 2.833.088 3.565-.572.73-1.54.73-3.476.73H8.568c-1.936 0-2.904 0-3.476-.73-.573-.732-.353-1.676.088-3.565l1.263-5.407a1 1 0 0 1 .972-.773h8.97a1 1 0 0 1 .972.773Z" />
    </svg>
    @if($total > 0)
        <span class="absolute top-1 right-0.5 min-w-[18px] h-[18px] bg-red-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full border-2 border-white animate-bounce">{{ $total }}</span>
    @endif
</a>
