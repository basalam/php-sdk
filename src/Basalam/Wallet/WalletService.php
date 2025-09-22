<?php

namespace Basalam\Wallet;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Wallet\Models\BalanceFilter;
use Basalam\Wallet\Models\CanRollbackRefundResponse;
use Basalam\Wallet\Models\CreditCreationResponse;
use Basalam\Wallet\Models\HistoryPaginationResponse;
use Basalam\Wallet\Models\RefundRequest;
use Basalam\Wallet\Models\RollbackRefundRequest;
use Basalam\Wallet\Models\SpendCreditRequest;
use Basalam\Wallet\Models\SpendResponse;
use Basalam\Wallet\Models\SpendSpecificCreditRequest;
use Exception;

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
        $endpoint = "/v2/user/$userId/balance";
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
        $endpoint = "/v2/user/$userId/history";
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
        $endpoint = "/v2/user/$userId/spend";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Create an expense from a specific credit.
     *
     * @param int $userId The ID of the user
     * @param int $creditId The ID of the credit to spend from
     * @param SpendSpecificCreditRequest $request The spend credit request
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The spend response
     */
    public function createExpenseFromCredit(
        int                        $userId,
        int                        $creditId,
        SpendSpecificCreditRequest $request,
        ?int                       $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v2/user/$userId/credit/$creditId/spend";
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
        $endpoint = "/v2/user/$userId/spend/$expenseId";
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
        $endpoint = "/v2/user/$userId/spend/$expenseId";
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
        $endpoint = "/v2/user/$userId/spend/by-ref/$reasonId/$referenceId";
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
        $endpoint = "/v2/user/$userId/spend/by-ref/$reasonId/$referenceId";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $payload = ['rollback_reason_id' => $rollbackReasonId];
        $response = $this->delete($endpoint, [], $payload, $headers);
        return SpendResponse::fromArray($response);
    }

    /**
     * Create a refund.
     *
     * @param RefundRequest $request The refund request
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return CreditCreationResponse|SpendResponse Either a credit creation response or a spend response
     */
    public function createRefund(RefundRequest $request, ?int $xOperatorId = null): SpendResponse|CreditCreationResponse
    {
        $endpoint = "/v2/refund";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->post($endpoint, $request->toArray(), [], $headers);

        // The API can return either a CreditCreationResponse or a SpendResponse
        // Try to parse as CreditCreationResponse first, then fallback to SpendResponse
        try {
            return CreditCreationResponse::fromArray($response);
        } catch (Exception $e) {
            return SpendResponse::fromArray($response);
        }
    }

    /**
     * Check if a refund can be rolled back.
     *
     * @param int $refundReason The refund reason
     * @param int $refundReferenceId The refund reference ID
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return CanRollbackRefundResponse Response containing status and message
     */
    public function canRollbackRefund(
        int  $refundReason,
        int  $refundReferenceId,
        ?int $xOperatorId = null
    ): CanRollbackRefundResponse
    {
        $endpoint = "/v2/can-rollback-refund";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $payload = [
            'refund_reason' => $refundReason,
            'refund_reference_id' => $refundReferenceId
        ];

        $response = $this->post($endpoint, $payload, [], $headers);
        return CanRollbackRefundResponse::fromArray($response);
    }

    /**
     * Rollback a refund.
     *
     * @param RollbackRefundRequest $request The rollback refund request
     * @param int|null $xOperatorId Optional operator ID for the request
     * @return SpendResponse The rollback response
     */
    public function rollbackRefund(
        RollbackRefundRequest $request,
        ?int                  $xOperatorId = null
    ): SpendResponse
    {
        $endpoint = "/v2/rollback-refund";
        $headers = [];
        if ($xOperatorId !== null) {
            $headers['x-operator-id'] = (string)$xOperatorId;
        }

        $response = $this->delete($endpoint, $request->toArray(), [], $headers);
        return SpendResponse::fromArray($response);
    }
}