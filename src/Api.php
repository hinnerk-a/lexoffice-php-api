<?php

declare(strict_types=1);

namespace Sysix\LexOffice;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use SensitiveParameter;
use Sysix\LexOffice\Clients\Article;
use Sysix\LexOffice\Clients\Contact;
use Sysix\LexOffice\Clients\Country;
use Sysix\LexOffice\Clients\CreditNote;
use Sysix\LexOffice\Clients\DeliveryNote;
use Sysix\LexOffice\Clients\DownPaymentInvoice;
use Sysix\LexOffice\Clients\Dunning;
use Sysix\LexOffice\Clients\Event;
use Sysix\LexOffice\Clients\File;
use Sysix\LexOffice\Clients\Invoice;
use Sysix\LexOffice\Clients\OrderConfirmation;
use Sysix\LexOffice\Clients\Payment;
use Sysix\LexOffice\Clients\PaymentCondition;
use Sysix\LexOffice\Clients\PostingCategory;
use Sysix\LexOffice\Clients\PrintLayout;
use Sysix\LexOffice\Clients\Profile;
use Sysix\LexOffice\Clients\Quotation;
use Sysix\LexOffice\Clients\RecurringTemplate;
use Sysix\LexOffice\Clients\Voucher;
use Sysix\LexOffice\Clients\VoucherList;
use Sysix\LexOffice\Interfaces\ApiInterface;

class Api implements ApiInterface
{
    public string $apiUrl = 'https://api.lexoffice.io';

    protected string $apiVersion = 'v1';

    protected RequestInterface $request;

    public function __construct(
        #[SensitiveParameter] protected string $apiKey,
        protected ClientInterface $client
    ) {
    }

    public function newRequest(string $method, string $resource, array $headers = []): self
    {
        return $this->setRequest(
            new Request($method, $this->createApiUri($resource), $headers)
        );
    }

    public function setRequest(RequestInterface $request): self
    {
        if (!$request->hasHeader('Authorization')) {
            $request = $request->withHeader('Authorization', 'Bearer ' . $this->apiKey);
        }

        if (!$request->hasHeader('Accept')) {
            $request = $request->withHeader('Accept', 'application/json');
        }

        if (!$request->hasHeader('Content-Type') && in_array($request->getMethod(), ['POST', 'PUT'], true)) {
            $request = $request->withHeader('Content-Type', 'application/json');
        }

        $this->request = $request;

        return $this;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->client->sendRequest($this->request);
    }

    protected function createApiUri(string $resource): UriInterface
    {
        return new Uri($this->apiUrl . '/' . $this->apiVersion . '/' . $resource);
    }

    public function article(): Article
    {
        return new Article($this);
    }

    public function contact(): Contact
    {
        return new Contact($this);
    }

    public function country(): Country
    {
        return new Country($this);
    }

    public function creditNote(): CreditNote
    {
        return new CreditNote($this);
    }

    public function deliveryNote(): DeliveryNote
    {
        return new DeliveryNote($this);
    }
    public function downPaymentInvoice(): DownPaymentInvoice
    {
        return new DownPaymentInvoice($this);
    }

    public function dunning(): Dunning
    {
        return new Dunning($this);
    }

    public function event(): Event
    {
        return new Event($this);
    }

    public function file(): File
    {
        return new File($this);
    }

    public function invoice(): Invoice
    {
        return new Invoice($this);
    }

    public function orderConfirmation(): OrderConfirmation
    {
        return new OrderConfirmation($this);
    }

    public function payment(): Payment
    {
        return new Payment($this);
    }

    public function paymentCondition(): PaymentCondition
    {
        return new PaymentCondition($this);
    }
    public function postingCategory(): PostingCategory
    {
        return new PostingCategory($this);
    }

    public function printLayout(): PrintLayout
    {
        return new PrintLayout($this);
    }

    public function profile(): Profile
    {
        return new Profile($this);
    }

    public function quotation(): Quotation
    {
        return new Quotation($this);
    }

    public function recurringTemplate(): RecurringTemplate
    {
        return new RecurringTemplate($this);
    }

    public function voucher(): Voucher
    {
        return new Voucher($this);
    }

    public function voucherlist(): VoucherList
    {
        return new VoucherList($this);
    }

}
