public class Empleado {
    private String ci;
    private String nombre;
    private String cargo;
    private double sueldoBase;
    private double bono;
    private double descuento;
    private double aporte;
    private double sueldoNeto;

    public Empleado(String ci, String nombre, String cargo, double sueldoBase) {
        this.ci = ci;
        this.nombre = nombre;
        this.cargo = cargo;
        this.sueldoBase = sueldoBase;
        this.bono = 0;
        this.descuento = 0;
    }

    public void calcularSueldo() {
        aporte = sueldoBase * 0.1271; // ejemplo aporte (12.71%)
        sueldoNeto = sueldoBase + bono - descuento - aporte;
    }

    // Getters y Setters
    public String getCi() { return ci; }
    public String getNombre() { return nombre; }
    public String getCargo() { return cargo; }
    public double getSueldoBase() { return sueldoBase; }
    public double getBono() { return bono; }
    public double getDescuento() { return descuento; }
    public double getAporte() { return aporte; }
    public double getSueldoNeto() { return sueldoNeto; }

    public void setBono(double bono) { this.bono = bono; }
    public void setDescuento(double descuento) { this.descuento = descuento; }
}
