_surface.diffuse = pow(float4(0.948, 0.659, 0.255, 1.0), 2.3);
_surface.emission = pow(float4(0.584, 0.208, 0.086, 1.0), 2.3);
// EdgesDarkeningColor
_surface.ambient = pow(float4(0.889, 0.113, 0, 1.0), 2.3);
// edgeDark_rimLight
_surface.reflective = float4(0.6, 2.5, 0, 0);
// SpecularColor
_surface.multiply = float4(1.0, 1.0, 1.0, 1.0);
// Wrap
_surface.specular = float4(0.0, 0.2, -8.0, 0.0);
