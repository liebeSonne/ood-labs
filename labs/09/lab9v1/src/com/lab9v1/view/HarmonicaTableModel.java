package com.lab9v1.view;

import com.lab9v1.model.HarmonicaExecutor;

import javax.swing.table.AbstractTableModel;
import javax.swing.table.TableModel;

public class HarmonicaTableModel extends AbstractTableModel implements TableModel{
    private HarmonicaExecutor harmonica;
    double minX;
    double maxX;
    double delta;

    String[] columnNames = {"x", "y"};

    public HarmonicaTableModel(HarmonicaExecutor harmonica, double minX, double maxX, double delta) {
        super();
        this.harmonica = harmonica;
        this.minX = minX;
        this.maxX = maxX;
        this.delta = delta;
    }

    @Override
    public int getRowCount() {
        return delta == 0 ? 0 : (int)(Math.abs(maxX - minX) / delta);
    }

    @Override
    public int getColumnCount() {
        return 2;
    }

    @Override
    public Object getValueAt(int rowIndex, int columnIndex) {
        double x = this.minX + delta * (rowIndex);
        if (columnIndex == 0) {
            return x;
        } else if (columnIndex == 1) {
            return this.harmonica.execute(x);
        }
        return null;
    }

    public Class<?> getColumnClass(int columnIndex) {
        return Double.class;
    }

    public boolean isCellEditable(int row, int column){
        return false;
    }

    public String getColumnName(int column) {
        return columnNames[column];
    }
}
