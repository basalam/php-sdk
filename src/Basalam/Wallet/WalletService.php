<?php

namespace Basalam\Wallet;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Wallet\Models\BalanceFilter;
use Basalam\Wallet\Models\HistoryPaginationResponse;
use Basalam\Wallet\Models\SpendCreditRequest;
use Basalam\Wallet\Models\SpendResponse;

/**
 * Client for the Basalam Wallet Service API.
 *
 * This client provides methods for interacting with user balances,
 * spending credits, and managing refunds.
 */
class WalletService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'wallet');
    }

    /**
     * Get a user's balances.
     *
     * @param int $userId The ID of the user
     * @param BalanceFilter[]|null $filters Optional list of BalanceFilter objects
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return array The user's balance information
     */
    public function getBalance(int $userId, ?array $filters = null, ?int $xOperatorId = null): array
    {
        $endpoint = "/v1/users/$userId/balance";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        // Prepare filters payload
        $filtersArray = [];
        if (empty($filters)) {
            $filtersArray = [[]]; // Default empty filter
        } else {
            foreach ($filters as $filter) {
                if ($filter instanceof BalanceFilter) {
                    $filtersArray[] = $filter->toArray();
                } else {
                    $filtersArray[] = $filter;
                }
            }
        }

        $payload = ['filters' => $filtersArray];

        return $this->post($endpoint, $payload, [], $headers);
    }

    /**
     * Get a user's transaction history.
     *
     * @param int $userId The ID of the user
     * @param int $page Page number for pagination
     * @param int $perPage Number of items per page
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return HistoryPaginationResponse The user's transaction history
     */
    public function getTransactions(
        int  $userId,
        int  $page = 1,
        int  $perPage = 50,
        ?int $xOperatorId = null
    ): HistoryPaginationResponse
    {
        $endpoint = "/v1/users/$userId/transactions";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $params = [
            'page' => $page,
            'per_page' => $perPage
        ];

        $response = $this->get($endpoint, $params, $headers);
        return HistoryPaginationResponse::fromArray($response);
    }

    /**
     * Create an expense from a user's balance.
     *
     * @param int $userId The ID of the user
     * @param SpendCreditRequest $request The spend credit request
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The spend response
     */
    public function createExpense(
        int                $userId,
        SpendCreditRequest $request,
        ?int               $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v1/users/$userId/expenses";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Get details of a specific expense.
     *
     * @param int $userId The ID of the user
     * @param int $expenseId The ID of the expense
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The expense details
     */
    public function getExpense(int $userId, int $expenseId, ?int $xOperatorId = null): SpendResponse
    {
        $endpoint = "/v1/users/$userId/expenses/$expenseId";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->get($endpoint, [], $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Delete an expense.
     *
     * @param int $userId The ID of the user
     * @param int $expenseId The ID of the expense to delete
     * @param int $rollbackReasonId The reason ID for the rollback
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The rollback response
     */
    public function deleteExpense(
        int  $userId,
        int  $expenseId,
        int  $rollbackReasonId,
        ?int $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v1/users/$userId/expenses/$expenseId";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $payload = ['rollback_reason_id' => $rollbackReasonId];
        $response = $this->delete($endpoint, [], $payload, $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Get expense details by reference.
     *
     * @param int $userId The ID of the user
     * @param int $reasonId The reason ID
     * @param int $referenceId The reference ID
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The expense details
     */
    public function getExpenseByRef(
        int  $userId,
        int  $reasonId,
        int  $referenceId,
        ?int $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v1/users/$userId/expenses/by-ref/$reasonId/$referenceId";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->get($endpoint, [], $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Delete an expense by reference.
     *
     * @param int $userId The ID of the user
     * @param int $reasonId The reason ID
     * @param int $referenceId The reference ID
     * @param int $rollbackReasonId The reason ID for the rollback
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The rollback response
     */
    public function deleteExpenseByRef(
        int  $userId,
        int  $reasonId,
        int  $referenceId,
        int  $rollbackReasonId,
        ?int $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v1/users/$userId/expenses/by-ref/$reasonId/$referenceId";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $payload = ['rollback_reason_id' => $rollbackReasonId];
        $response = $this->delete($endpoint, [], $payload, $headers);
        return SpendResponse::fromArray($response);
    }

}