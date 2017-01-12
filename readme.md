# Product & Image Uploader

## APIs

#### Product APIs
- Create Product
```
POST /product/

Type: application/json

Body
{
	"name": "string",
	"price": float.0
}

Response
{
	"product_id": integer
}
```
- List Products
```
GET /product/

Response
[{
	"product_id": integer,
	"name": "string",
	"price": float.0
}]
```
- Get Product with ID
```
GET /product/{id}

Response
{
	"product_id": integer,
	"name": "string",
	"price": float.0
}
```

#### Image APIs
- Upload Image
```
POST /product/{product_id}/image

Type: multipart/form-data

Body
"image" - File. 

Response
{
	"image_id": integer
}
```