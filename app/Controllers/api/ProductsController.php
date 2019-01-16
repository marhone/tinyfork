<?php
/**
 * ProductsController
 * User: marhone
 * Date: 2019/1/11
 * Time: 11:51
 */

namespace App\Controllers\api;


use App\Entities\Product;
use Tinyfork\Http\Request;
use Tinyfork\Http\Response;

class ProductsController
{
    // List all products
    public function list()
    {
        $em = orm();

        $repository = $em->getRepository(Product::class);

        $products = $repository->findAll();

        $all = [];
        foreach ($products as $product) {
            $all[] = [
                'id' => $product->getId(),
                'name' => $product->getName()
            ];
        }

        return response()->json(['data' => $all]);
    }

    // save a product
    public function store(Request $request)
    {
        $name = $request->post('name');

        $product = new Product();
        $product->setName($name);

        $em = orm();

        $em->persist($product);
        $em->flush();

        return response()->json([
            'id' => $product->getId(),
            'name' => $product->getName()
        ], Response::HTTP_CREATED);
    }

    // show a product detail
    public function show($id)
    {
        $em = orm();

        $repository = $em->getRepository(Product::class);
        $product = $repository->find($id);

        return response()->json([
            'id' => $product->getId(),
            'name' => $product->getName()
        ]);
    }

    // update a product
    public function update(Request $request, $id)
    {
        $name = $request->put('name');

        $em = orm();
        $repository = $em->getRepository(Product::class);
        $product = $repository->find($id);

        $product->setName($name);

        $em->flush();

        return response()->json([
            'id' => $product->getId(),
            'name' => $product->getName()
        ]);
    }

    // delete a product
    public function delete($id)
    {
        $em = orm();
        $repository = $em->getRepository(Product::class);
        $product = $repository->find($id);

        $em->remove($product);

        $em->flush();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}