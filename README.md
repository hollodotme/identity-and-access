# Identity and Access

This is a PHP7 implementation of the identity and access management domain, described in @VaughnVernon's book ["Implementing Domain-Driven Design"](http://amzn.to/28MAGRi).

The implementation extends the original domain with 

* contexts, so an identity can have different roles in different contexts and different tenants.
* event sourcing is based on a MySql event store
* CQRS with read model projection to a [redis](http://redis.io) database


## API

### Register a new tenant

#### Request

```HTTP
POST http://www.identity-and-access.de/api/v1/tenant
tenantName=CrazyCustomer
```

#### Responses

##### Success

```HTTP
HTTP/1.1 200 OK
Content-Type: text/plain; charset=utf-8
OK
```

##### Error, tenant already registered

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantName": [
        "CrazyCustomer is already registered with ID: 332894d2-3ce3-40c9-956b-efdd9b96523e"
    ]
}
```

##### Error, tenantName is invalid

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantName": [
        "Tenant name must be a valid, non-empty string."
    ]
}
```

### Block a tenant

#### Request

```HTTP
POST http://www.identity-and-access.de/api/v1/tenant/block
tenantId=332894d2-3ce3-40c9-956b-efdd9b96523e
```

#### Responses

##### Success

```HTTP
HTTP/1.1 200 OK
Content-Type: text/plain; charset=utf-8
OK
```

##### Error, tenant ID is malformed

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantId": [
        "Tenant ID must be a valid UUID string."
    ]
}
```

##### Error, tenant ID not found

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantId": [
        "332894d2-3ce3-40c9-956b-efdd9b96523e not found."
    ]
}
```

##### Error, tenant illegal state transition (tenant is already blocked)

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantState": [
        "Illegal tenant state transition."
    ]
}
```

### Unblock a tenant

#### Request

```HTTP
POST http://www.identity-and-access.de/api/v1/tenant/unblock
tenantId=332894d2-3ce3-40c9-956b-efdd9b96523e
```

#### Responses

##### Success

```HTTP
HTTP/1.1 200 OK
Content-Type: text/plain; charset=utf-8
OK
```

##### Error, tenant ID is malformed

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantId": [
        "Tenant ID must be a valid UUID string."
    ]
}
```

##### Error, tenant ID not found

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantId": [
        "332894d2-3ce3-40c9-956b-efdd9b96523e not found."
    ]
}
```

##### Error, tenant illegal state transition (tenant is already unblocked)

```HTTP
HTTP/1.1 400 Bad Request
Content-Type: application/json; charset=utf-8
{
    "tenantState": [
        "Illegal tenant state transition."
    ]
}
```

### List tenants

#### Request (all tenants)

```HTTP
GET http://www.identity-and-access.de/api/v1/tenant/list
```

#### Request (tenants with state blocked)

```HTTP
GET http://www.identity-and-access.de/api/v1/tenant/list?states[]=blocked
```

#### Request (tenants with state unblocked)

```HTTP
GET http://www.identity-and-access.de/api/v1/tenant/list?states[]=unblocked
```

#### Responses

##### Success

```HTTP
HTTP/1.1 200 OK
Content-Type: appliction/json; charset=utf-8
[
    {
        "tenantId": "e53ed5d7-8378-48e1-83bc-63dbbbb49ca5",
        "tenantName": "MoreAndMore",
        "tenantState": "blocked"
    },
    {
        "tenantId": "f70e8564-5714-4236-8f25-e78d8ad034e2",
        "tenantName": "Carl Gross",
        "tenantState": "unblocked"
    }
]
```

```HTTP
HTTP/1.1 200 OK
Content-Type: appliction/json; charset=utf-8
[
    {
        "tenantId": "e53ed5d7-8378-48e1-83bc-63dbbbb49ca5",
        "tenantName": "MoreAndMore",
        "tenantState": "blocked"
    }
]
```

```HTTP
HTTP/1.1 200 OK
Content-Type: appliction/json; charset=utf-8
[
    {
        "tenantId": "f70e8564-5714-4236-8f25-e78d8ad034e2",
        "tenantName": "Carl Gross",
        "tenantState": "unblocked"
    }
]
```

##### Error

```HTTP
HTTP/1.1 500 Internal Server Error
Content-Type: application/json; charset=utf-8
{
    "error": [
        "<Error message>"
    ]
}
```
