package com.lab9v1.view;

import com.lab9v1.controller.MainController;
import com.lab9v1.model.DocumentObserver;
import com.lab9v1.model.Formula;
import com.lab9v1.model.Harmonica;
import com.lab9v1.model.UnaryFunction;
import com.lab9v1.view.chart.Chart;

import javax.swing.*;
import javax.swing.event.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.text.NumberFormatter;
import java.awt.event.*;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Optional;

public class App implements DocumentObserver {
    private JButton addNewButton;
    private JButton deleteSelectedButton;
    private JFormattedTextField amplitudeTextField;
    private JList harmonicsList;
    private JTabbedPane tabbedPane;
    private JTable table;
    private JRadioButton sinRadioButton;
    private JRadioButton cosRadioButton;
    private JFormattedTextField frequencyTextField;
    private JFormattedTextField phaseTextField;
    private JPanel mainPanel;
    private JPanel selectedHarmonicaPanel;
    private JPanel listPanel;
    private JPanel chartPanel;
    private JButton updButton;
    private ButtonGroup formulaButtonGroup;

    private final MainController controller;
    private Optional<Harmonica> selectedHarmonica;

    private int selectedHarmonicaIndex = -1;

    private double minX = 0;
    private double maxX = 8;
    private double delta = 0.5;

    private boolean listenChange = true;

    public App(MainController controller) {
        this.controller = controller;
        this.controller.getDocument().register(this);
        this.controller.getDocument().register((DocumentObserver) this.chartPanel);

        HarmonicaTableModel dataModel = new HarmonicaTableModel((UnaryFunction) this.controller.getDocument(), minX, maxX, delta);
        this.table.setModel(dataModel);

        this.drawList();
        this.drawSelectedHarmonica();

        this.bindBtnEvents();
        this.bindListEvents();
        this.bindChangeSelectedEvents();
    }

    public JPanel getMainPanel() {
        return mainPanel;
    }

    private void bindBtnEvents() {
        addNewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onAddNewButton();
            }
        });
        deleteSelectedButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                onDeleteSelectedButton();
            }
        });

        updButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                drawList();
            }
        });
    }

    private void bindListEvents () {
        harmonicsList.addListSelectionListener(new ListSelectionListener() {
            @Override
            public void valueChanged(ListSelectionEvent e) {
                int index = ((JList) e.getSource()).getSelectedIndex();
                if (index == selectedHarmonicaIndex) {
                    return;
                }
                selectedHarmonicaIndex = index;
                onSelectHarmonica();
            }
        });
    }

    private void bindChangeSelectedEvents() {
        DocumentListener listener = new DocumentListener() {
            @Override
            public void insertUpdate(DocumentEvent e) {
                onChangeSelectedHarmonica();
            }

            @Override
            public void removeUpdate(DocumentEvent e) {
                onChangeSelectedHarmonica();
            }

            @Override
            public void changedUpdate(DocumentEvent e) {

            }
        };

        amplitudeTextField.getDocument().addDocumentListener(listener);
        frequencyTextField.getDocument().addDocumentListener(listener);
        phaseTextField.getDocument().addDocumentListener(listener);

        sinRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                onChangeSelectedHarmonica();
            }
        });
        cosRadioButton.addItemListener(new ItemListener() {
            @Override
            public void itemStateChanged(ItemEvent event) {
                onChangeSelectedHarmonica();
            }
        });
    }

    private void onAddNewButton() {
        Harmonica harmonica = new Harmonica(1, Formula.SIN, 1, 0);
        JDialog dialog = new AddNewHarmonic(controller, harmonica);
        dialog.pack();
        dialog.setDefaultCloseOperation(JDialog.DISPOSE_ON_CLOSE);
        dialog.setVisible(true);
     }

     private void onDeleteSelectedButton() {
        if (this.selectedHarmonica != null && this.selectedHarmonica.isPresent()) {
            this.controller.removeHarmonica(this.selectedHarmonica.get());
        }
     }

     private void drawList() {
         DefaultListModel data = new DefaultListModel();
         this.controller.getDocument().getHarmonics().forEach(harmonica -> {
             data.addElement(harmonica);
         });
         this.harmonicsList.setModel(data);
     }

     private void onSelectHarmonica() {
        if (!this.listenChange) return;
        this.listenChange = false;
        Harmonica selected = (Harmonica) this.harmonicsList.getSelectedValue();
        this.selectedHarmonica = Optional.ofNullable(selected);
        drawSelectedHarmonica();
        this.listenChange = true;
     }

    private void drawSelectedHarmonica() {
        if (this.selectedHarmonica != null && this.selectedHarmonica.isPresent()) {
            setData(this.selectedHarmonica.get());
        } else {
            this.setDataNull();
        }
    }

    private void setData(Harmonica data) {
        this.listenChange = false;
        if (this.isModified(data)) {
            amplitudeTextField.setValue(data.getAmplitude());
            frequencyTextField.setValue(data.getFrequency());
            phaseTextField.setValue(data.getPhase());
            formulaButtonGroup.clearSelection();
            switch (data.getFormula()) {
                case COS -> cosRadioButton.setSelected(true);
                case SIN -> sinRadioButton.setSelected(true);
            }
        }
        this.listenChange = true;
    }

    private void setDataNull() {
        this.listenChange = false;
        amplitudeTextField.setValue(0);
        frequencyTextField.setValue(0);
        phaseTextField.setValue(0);
        formulaButtonGroup.clearSelection();
        sinRadioButton.setSelected(true);
        this.listenChange = true;
    }

    private void getData(Harmonica data) {
        data.setAmplitude(getAmplitude());
        data.setFrequency(getFrequency());
        data.setPhase(getPhase());
        data.setFormula(this.getFormula());
    }

    public boolean isModified(Harmonica data) {
        if (amplitudeTextField.getText() == null || !amplitudeTextField.getText().equals(Double.toString(data.getAmplitude())))
            return true;
        if (frequencyTextField.getText() == null || !frequencyTextField.getText().equals(Double.toString(data.getFrequency())))
            return true;
        if (phaseTextField.getText() == null || !phaseTextField.getText().equals(Double.toString(data.getPhase())))
            return true;
        if (formulaButtonGroup.getSelection() != null ? formulaButtonGroup.getSelection().equals(this.convertFromFormula(data.getFormula())) : data.getFormula() != null)
            return true;
        return false;
    }

    private JRadioButton convertFromFormula(Formula formula){
        switch (formula) {
            case COS -> {return cosRadioButton;}
            case SIN -> {return sinRadioButton;}
        }
        return null;
    }

    private double getAmplitude() {
        Object value = amplitudeTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private Formula getFormula() {
        if (cosRadioButton.isSelected()) {
            return Formula.COS;
        } else {
            return Formula.SIN;
        }
    }

    private double getFrequency() {
        Object value = frequencyTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    private double getPhase() {
        Object value = phaseTextField.getValue();
        if (value == null ) return 0;
        return (Double) value;
    }

    @Override
    public void update() {
        this.drawList();
    }

    private void onChangeSelectedHarmonica() {
        if (!listenChange) return;
        if (this.selectedHarmonica != null && this.selectedHarmonica.isPresent()) {
            listenChange = false;

            Harmonica harmonica = this.selectedHarmonica.get();
            Harmonica newHarmonica = new Harmonica(harmonica.getAmplitude(),harmonica.getFormula(),harmonica.getFrequency(), harmonica.getPhase()) ;

            this.getData(newHarmonica);

            this.controller.changeHarmonica(harmonica, newHarmonica);

            listenChange = true;
        }
    }

    private void createUIComponents() {
        DecimalFormat format = new DecimalFormat("##0.###");
        NumberFormatter formatter = new NumberFormatter(format);
        formatter.setAllowsInvalid(false);
        formatter.setValueClass(Double.class);

        this.frequencyTextField = new JFormattedTextField(formatter);
        this.amplitudeTextField = new JFormattedTextField(formatter);
        this.phaseTextField = new JFormattedTextField(formatter);

        ArrayList<UnaryFunction> unaryFunctionList = new ArrayList<UnaryFunction>();
        unaryFunctionList.add((UnaryFunction) this.controller.getDocument());

        this.chartPanel = new Chart(unaryFunctionList);
    }
}
