<?php

namespace App\Controllers;

use App\Models\Apartment;
use App\Services\Apartment\Show\ShowApartmentRequest;
use App\Services\Apartment\Show\ShowApartmentService;
use App\Services\Apartment\Store\StoreApartmentRequest;
use App\Services\Apartment\Store\StoreApartmentService;
use App\View;
use App\Validations\Errors;
use App\Database;
use App\Redirect;
use App\Validations\ApartmentValidator;
use App\Exceptions\ApartmentValidationException;

class ApartmentController
{
    public function create(): View
    {
        return new View('Apartment/create', [
            'userName' => $_SESSION["userSession"]['name'] ?? null,
            'userSurname' => $_SESSION["userSession"]['surname'] ?? null,
            'userId' => $_SESSION["userSession"]['id'] ?? null,
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? []
        ]);
    }

    public function store(): Redirect
    {
        try {
            $validator = (new ApartmentValidator($_POST, [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'address' => 'required'
            ]));
            $validator->passes();
        } catch (ApartmentValidationException $exception) {

            $_SESSION['errors'] = $validator->getErrors();
            $_SESSION['inputs'] = $_POST;

            return new Redirect('/Booking2.0/index.php/apartment/create');
        }

        $service = new StoreApartmentService();
        $service->execute(new StoreApartmentRequest(
            $_POST['title'],
            $_POST['description'],
            $_POST['address'],
            $_POST['price'],
            $_SESSION["userSession"]['id']
        ));

        /*Database::connection()
            ->insert('apartments', [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'address' => $_POST['address'],
                'price' => $_POST['price'],
                'user_id' => $_SESSION["userSession"]['id']
            ]);*/

        return new Redirect('/Booking2.0/index.php/');
    }

    public function show(array $vars): View
    {
        $apartmentId = (int)$vars['id'];

        $service = new ShowApartmentService();
        $response = $service->execute(new ShowApartmentRequest($apartmentId));

        $apartmentQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartments')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        $apartment = new Apartment(
            $apartmentQuery['id'],
            $apartmentQuery['user_id'],
            $apartmentQuery['title'],
            $apartmentQuery['description'],
            $apartmentQuery['address'],
            $apartmentQuery['created_at'],
            $apartmentQuery['price']
        );

        return new View('Apartment/show', [
            'apartment' => $apartment,
            'userName' => $_SESSION["userSession"]['name'] ?? null,
            'userSurname' => $_SESSION["userSession"]['surname'] ?? null,
            'userId' => $_SESSION["userSession"]['id'] ?? null,
            'errors' => Errors::getAll(),
            'inputs' => $_SESSION['inputs'] ?? [],
            'date' => date('Y-m-d'),
        ]);
    }

    public function delete(array $vars): Redirect
    {
        Database::connection()
            ->delete('apartments', [
                'id' => (int) $vars['id']
            ]);

        return new Redirect('/Booking2.0/index.php/');
    }
}