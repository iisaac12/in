use App\Http\Controllers\InventarisController;

Route::get('/inventaris', [InventarisController::class, 'index']);
Route::get('/inventaris/{id}', [InventarisController::class, 'show']);
Route::post('/inventaris', [InventarisController::class, 'store']); 
