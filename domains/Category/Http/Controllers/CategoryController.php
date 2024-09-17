<?php

namespace Domains\Category\Http\Controllers;
use Domains\Base\Http\Controllers\AppBaseController;
use Domains\Category\Http\Requests\CreateCategoryRequest;
use Domains\Category\Http\Requests\UpdateCategoryRequest;
use Domains\Category\Http\Resources\CategoryResource;
use Domains\Category\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CategoryController extends AppBaseController
{

    /** @var  CategoryRepository */
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * Display a listing of the Category.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $categories = $this->categoryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        )->search();

        if ($request->category_id){
            $categories = $categories->where('parent_id',$request->category_id);
        }

        return $this->sendResponse(CategoryResource::collection($categories), __('messages.retrieved'));
    }

    /**
     * Store a newly created Category in storage.
     * POST /categories
     *
     * @param CreateCategoryRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $input = $request->all();
        $image = $this->saveImage($request->file('image'), 'categories');
        $input['image'] = $image;
        $category = $this->categoryRepository->create($input);

        return $this->sendResponse(new CategoryResource($category), __('messages.saved'));
    }

    /**
     * Display the specified Category.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = $this->categoryRepository->findOrFail($id);

        return $this->sendResponse(new CategoryResource($category), __('messages.retrieved'));
    }

    /**
     * Update the specified Category in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param int $id
     * @param UpdateCategoryRequest $request
     *
     * @return JsonResponse
     */
    public function update(int $id, UpdateCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryRepository->findOrFail($id);
        $input = $request->all();
        $image = $request->hasFile('image') ?$this->updateImage($category->image,$request->file('image'), 'categories'):$category->image;
        $input['image'] = $image;
        $category = $this->categoryRepository->update($input, $id);

        return $this->sendResponse(new CategoryResource($category), __('messages.updated'));
    }

    /**
     * Remove the specified Category from storage.
     * DELETE /categories/{id}
     *
     * @param int $id
     *
     * @return JsonResponse
     *
     */
    public function destroy(int $id): JsonResponse
    {
        $category = $this->categoryRepository->findOrFail($id);
        $this->fileRemove($category->image);
        $category->delete();

        return $this->sendResponse($id, __('messages.deleted'));
    }
}
